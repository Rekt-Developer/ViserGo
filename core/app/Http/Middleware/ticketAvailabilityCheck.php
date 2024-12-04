<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;
use App\Models\Lottery;

class ticketAvailabilityCheck
{
    public function handle($request, Closure $next)
    {
        if (session('cartItemPriceTotal'))
        {
            $carts = Cart::select('lottery_id', 'choosen_tickets')->where('user_id', auth()->id())->get();
            $groupCartTickets = $carts->groupBy('lottery_id')->map(fn($items) => $items->flatMap(fn($item) => $item->choosen_tickets));

            foreach ($groupCartTickets as $id => $ticket)
            {
                $lottery = Lottery::find($id);
                $checkLotteryAvailability = checkPickedLottery($lottery, $ticket->toArray());
                if (!$checkLotteryAvailability)
                {
                    $notify[] = ['error', 'Your choosen ticket is not available'];
                    return to_route('cart')->withNotify($notify);
                }
            }
            return $next($request);
        }
        else
        {
            $notify[] = ['error', 'Your have nothing in your cart'];
            return back()->withNotify($notify);
        }
    }
}
