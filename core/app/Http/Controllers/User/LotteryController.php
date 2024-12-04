<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Lottery;
use App\Models\PickedTicket;
use App\Models\Winner;
use Illuminate\Http\Request;

class LotteryController extends Controller {
    public function cartItems() {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        $cartItemPrice = 0;

        foreach ($cartItems as $cartItem) {
            $cartItemPrice += $cartItem->lottery->price * $cartItem->quantity;
        }

        session()->forget('cartItemPriceTotal');
        session()->put('cartItemPriceTotal', $cartItemPrice);

        return redirect()->route('user.deposit.index');
    }

    public function purchasedLottery() {
        $pageTitle = "My Lotteries";
        $lotteries = Lottery::pickedAndWonByUser(auth()->id())->searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('Template::user.lottery.purchased', compact('pageTitle', 'lotteries'));
    }

    public function purchasedLotteryDetail(Request $request, $slug) {
        $lottery = Lottery::where('slug', $slug)->whereHas('pickedTickets')->first();

        if (!$lottery) {
            return redirect()->back()->withErrors(['error' => 'Lottery not found.']);
        }

        $pageTitle = $lottery->name;

        $pickedTickets = PickedTicket::where('lottery_id', $lottery->id)->where('user_id', auth()->id())->get();
        $totalPrice    = @$pickedTickets->sum('price');

        $allPickedTickets = $pickedTickets->pluck('choosen_tickets')->toArray();
        $pickedTickets    = array_merge(...$allPickedTickets);
        sort($pickedTickets);

        $winningTickets    = Winner::where('lottery_id', $lottery->id)->where('user_id', auth()->id())->get();
        $allWinningTickets = [];
        foreach ($winningTickets as $pickedTicket) {
            $allWinningTickets[] = $pickedTicket->ticket_number;
        }
        sort($allWinningTickets);
        return view('Template::user.lottery.purchased_detail', compact('pageTitle', 'lottery', 'pickedTickets', 'allWinningTickets', 'totalPrice'));
    }
}
