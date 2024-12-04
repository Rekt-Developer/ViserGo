<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Lib\CurlRequest;
use App\Models\Cart;
use App\Models\CronJob;
use App\Models\CronJobLog;
use App\Models\Lottery;
use App\Models\PickedTicket;
use App\Models\User;
use App\Models\Winner;
use Carbon\Carbon;

class CronController extends Controller {
    public function cron() {
        $general            = gs();
        $general->last_cron = now();
        $general->save();

        $crons = CronJob::with('schedule');

        if (request()->alias) {
            $crons->where('alias', request()->alias);
        } else {
            $crons->where('next_run', '<', now())->where('is_running', Status::YES);
        }
        $crons = $crons->get();
        foreach ($crons as $cron) {
            $cronLog              = new CronJobLog();
            $cronLog->cron_job_id = $cron->id;
            $cronLog->start_at    = now();
            if ($cron->is_default) {
                $controller = new $cron->action[0];
                try
                {
                    $method = $cron->action[1];
                    $controller->$method();
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            } else {
                try
                {
                    CurlRequest::curlContent($cron->url);
                } catch (\Exception $e) {
                    $cronLog->error = $e->getMessage();
                }
            }
            $cron->last_run = now();
            $cron->next_run = now()->addSeconds($cron->schedule->interval);
            $cron->save();

            $cronLog->end_at = $cron->last_run;

            $startTime         = Carbon::parse($cronLog->start_at);
            $endTime           = Carbon::parse($cronLog->end_at);
            $diffInSeconds     = $startTime->diffInSeconds($endTime);
            $cronLog->duration = $diffInSeconds;
            $cronLog->save();
        }

        if (request()->target == 'all') {
            $notify[] = ['success', 'Cron executed successfully'];
            return back()->withNotify($notify);
        }
        if (request()->alias) {
            $notify[] = ['success', keyToTitle(request()->alias) . ' executed successfully'];
            return back()->withNotify($notify);
        }
    }

    public function removeCartItem() {
        $cartItems = Cart::all();
        foreach ($cartItems as $cartItem) {
            $cartCreateTime = $cartItem->created_at;
            $now            = now();
            $timeDifference = $cartCreateTime->diffInMinute($now);

            if ($timeDifference > intval(gs('cart_duration'))) {
                $cartItem->delete();
            }
        }
    }

    public function drawLottery() {
        $lotteries = Lottery::where('draw_date', '<=', now())->active()->get();

        foreach ($lotteries as $lottery) {
            $allTickets         = collect(range($lottery->starting_from, $lottery->starting_from + $lottery->num_of_tickets - 1));
            $randWinningTickets = $allTickets->random($lottery->num_of_winning_tickets)->toArray();

            PickedTicket::where('lottery_id', $lottery->id)
                ->where('status', Status::PAYMENT_SUCCESS)
                ->chunk(50, function ($pickedTickets) use ($randWinningTickets) {
                    foreach ($pickedTickets as $pickedTicket) {
                        $choosenTickets = $pickedTicket->choosen_tickets;
                        foreach ($choosenTickets as $choosenTicket) {
                            $isWinner = in_array($choosenTicket, $randWinningTickets);

                            if ($isWinner) {
                                $winner                = new Winner;
                                $winner->user_id       = $pickedTicket->user_id;
                                $winner->lottery_id    = $pickedTicket->lottery_id;
                                $winner->ticket_number = $choosenTicket;
                                $winner->save();

                                $user = $winner->user;
                                notify($user, 'LOTTERY_WIN', [
                                    'lottery_name'    => $pickedTicket->lottery->name,
                                    'choosen_tickets' => $winner->ticket_number,
                                    'price_giving'    => $pickedTicket->lottery->price_giving,
                                ]);
                            }
                        }
                    }
                });

            $lottery->winning_tickets = $randWinningTickets;
            $lottery->is_drawn        = Status::LOTTERY_DRAWN;
            $lottery->status          = Status::DISABLE;
            $lottery->save();
        }
    }
}
