<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Cart;
use App\Models\Competition;
use App\Models\Frontend;
use App\Models\Language;
use App\Models\Lottery;
use App\Models\Page;
use App\Models\PickedTicket;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\Winner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller {
    public function index() {
        $pageTitle   = 'Home';
        $sections    = Page::where('tempname', activeTemplate())->where('slug', '/')->first();
        $seoContents = $sections->seo_content;
        $seoImage    = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::home', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function pages($slug) {
        $page        = Page::where('tempname', activeTemplate())->where('slug', $slug)->firstOrFail();
        $pageTitle   = $page->name;
        $sections    = $page->secs;
        $seoContents = $page->seo_content;
        $seoImage    = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::pages', compact('pageTitle', 'sections', 'seoContents', 'seoImage'));
    }

    public function contact() {
        $pageTitle   = "Contact Us";
        $user        = auth()->user();
        $page        = Page::where('tempname', activeTemplate())->where('slug', 'contact')->first();
        $sections    = $page->secs;
        $seoContents = $page->seo_content;
        $seoImage    = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::contact', compact('pageTitle', 'user', 'sections', 'seoContents', 'seoImage'));
    }

    public function contactSubmit(Request $request) {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        $request->session()->regenerateToken();

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $random = getNumber();

        $ticket           = new SupportTicket();
        $ticket->user_id  = auth()->id() ?? 0;
        $ticket->name     = $request->name;
        $ticket->email    = $request->email;
        $ticket->priority = Status::PRIORITY_MEDIUM;

        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title     = 'A new contact message has been submitted';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message                    = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message           = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug) {
        $policy      = Frontend::where('slug', $slug)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle   = $policy->data_values->title;
        $seoContents = $policy->seo_content;
        $seoImage    = @$seoContents->image ? frontendImage('policy_pages', $seoContents->image, getFileSize('seo'), true) : null;
        return view('Template::policy', compact('policy', 'pageTitle', 'seoContents', 'seoImage'));
    }

    public function changeLanguage($lang = null) {
        $language = Language::where('code', $lang)->first();
        if (!$language) {
            $lang = 'en';
        }

        session()->put('lang', $lang);
        return back();
    }

    public function blog() {
        $templateName = activeTemplateName();
        $blogs        = Frontend::where('tempname', $templateName)->where('data_keys', 'blog.element')->orderBy('id', 'desc')->paginate(getPaginate());
        $pageTitle    = 'Blog';
        $seoContents  = @$blogs->seo_content;
        $seoImage     = @$seoContents->image ? frontendImage('blog', $seoContents->image, getFileSize('seo'), true) : null;
        $page         = Page::where('tempname', activeTemplate())->where('slug', 'blog')->firstOrFail();
        $sections     = $page->secs;
        return view('Template::blog', compact('blogs', 'pageTitle', 'sections', 'seoContents', 'seoImage', 'sections'));
    }

    public function blogDetails($slug) {
        $blog        = Frontend::where('slug', $slug)->where('data_keys', 'blog.element')->firstOrFail();
        $latestBlogs = Frontend::where('data_keys', 'blog.element')->whereNot('slug', $slug)->orderBy('id', 'desc')->get();
        $pageTitle   = 'Blog Details';
        $seoContents = @$blog->seo_content;
        $seoImage    = @$seoContents->image ? frontendImage('blog', $seoContents->image, getFileSize('seo'), true) : null;
        return view('Template::blog_details', compact('blog', 'pageTitle', 'seoContents', 'seoImage', 'latestBlogs'));
    }

    public function cookieAccept() {
        Cookie::queue('gdpr_cookie', gs('site_name'), 43200);
    }

    public function cookiePolicy() {
        $cookieContent = Frontend::where('data_keys', 'cookie.data')->first();
        abort_if($cookieContent->data_values->status != Status::ENABLE, 404);
        $pageTitle = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        return view('Template::cookie', compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null) {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile  = realpath('assets/font/solaimanLipi_bold.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance() {
        $pageTitle = 'Maintenance Mode';
        if (gs('maintenance_mode') == Status::DISABLE) {
            return to_route('home');
        }
        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view('Template::maintenance', compact('pageTitle', 'maintenance'));
    }

    public function competionTypeLotteries($slug) {
        $competionTypeLotteries            = Competition::where('slug', $slug)->active()->with('lotteries')->firstOrFail();
        $pageTitle                         = $competionTypeLotteries->name;
        $competionTypeLotteries->lotteries = $competionTypeLotteries->lotteries()->active()->live()->orderBy('draw_date', 'asc')->paginate(getPaginate());
        return view('Template::competitiontype', compact('competionTypeLotteries', 'pageTitle'));
    }

    public function lotteryDetails($id, $slug) {
        $lottery    = Lottery::where('id', $id)->live()->active()->firstOrFail();
        $percentage = (($lottery->num_of_tickets - $lottery->num_of_available_tickets) / $lottery->num_of_tickets) * 100;
        $pageTitle  = 'Raffle Details';

        $instChooseTickets    = explode(',', $lottery->instant_choose_variation);
        $newInstChooseTickets = [];

        foreach ($instChooseTickets as $item) {
            if ($lottery->num_of_available_tickets >= $item) {
                $newInstChooseTickets[] = $item;
            }
        }

        if (auth()->check()) {
            $cartTickets = Cart::where('user_id', auth()->id())->where('lottery_id', $lottery->id)->pluck('choosen_tickets')->flatten()->toArray();
        } else {

            $cartTickets = Cart::whereNotNull('session_id')->where('session_id', session('cartSessionId'))->where('lottery_id', $lottery->id)->pluck('choosen_tickets')->flatten()->toArray();
        }

        $startingFrom     = $lottery->starting_from;
        $availableTickets = collect(range($startingFrom, $startingFrom + $lottery->num_of_tickets - 1));

        $ticketsPerSegment         = $lottery->num_of_tickets / $lottery->segments;
        $availableTicketsBySegment = $availableTickets->chunk($ticketsPerSegment);

        $ticketsDataSets = $availableTicketsBySegment->map(function ($segment) {
            return [
                'startfrom' => $segment->first(),
                'endat'     => $segment->last(),
                'values'    => $segment->toArray(),
            ];
        });

        return view('Template::lottery_detail', compact('lottery', 'pageTitle', 'percentage', 'newInstChooseTickets', 'ticketsDataSets', 'cartTickets'));
    }

    public function lotteryBookAny(Request $request) {
        return $this->bookingTicket($request);
    }

    public function lotteryBookSegmentwise(Request $request) {
        return $this->bookingTicket($request);
    }

    public function lotteryBookSingle(Request $request, $ticket) {
        return $this->bookingTicket($request, true, $ticket);
    }

    private function bookingTicket(Request $request, $isSingle = false, $ticket = null) {
        $lottery = Lottery::active()->live()->where('id', $request->id)->with("pickedTickets")->first();

        if (!$lottery) {
            return response()->json(['error' => 'Lottery not found']);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|lte:' . $lottery->num_of_available_tickets . '|max:' . $lottery->max_buy,
        ], [
            'quantity.lte' => 'The quantity exceeds the number of available tickets',
            'quantity.max' => 'The quantity exceeds the limit of buying tickets',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $cart = new Cart();
        if (auth()->check()) {
            $cart->user_id        = auth()->id();
            $cartTickets          = Cart::where('user_id', auth()->id())->where('lottery_id', $lottery->id)->pluck('choosen_tickets')->flatten()->toArray();
            $alreadyPickedTickets = PickedTicket::where('user_id', auth()->id())->where('lottery_id', $lottery->id)->pluck('choosen_tickets')->flatten()->toArray();

            if (count($alreadyPickedTickets) >= $lottery->max_buy) {
                return response()->json(['error' => 'You have reached the maximum number of tickets to buy']);
            }

        } else {
            session(['cartSessionId' => session()->getId()]);
            $cart->session_id = session('cartSessionId');
            $cartTickets      = Cart::whereNotNull('session_id')->where('session_id', $cart->session_id)->where('lottery_id', $lottery->id)->pluck('choosen_tickets')->flatten()->toArray();

        }

        if (count($cartTickets) >= $lottery->max_buy) {
            return response()->json(['error' => 'You have reached the maximum number of tickets to buy']);
        }

        if ($isSingle) {
            if ($request->quantity > 1) {
                return response()->json(['error' => 'Please select one Lottery only']);
            }

            $ticketArray              = [intval($ticket)];
            $checkLotteryAvailability = checkPickedLottery($lottery, $ticketArray);
            if (!$checkLotteryAvailability) {
                return response()->json(['error' => 'Your choosen ticket is not available']);
            }

            $checkSelected = checkCartLottery($cartTickets, $ticketArray);
            if ($checkSelected) {
                return response()->json(['error' => 'Your have already choosen the ticket']);
            }

            $cart->lottery_id      = $lottery->id;
            $cart->quantity        = 1;
            $cart->choosen_tickets = $ticketArray;
            $cart->save();

            $selectedTickets = $ticketArray;
        } else {
            $allTickets           = range($lottery->starting_from, $lottery->starting_from + $lottery->num_of_tickets - 1);
            $pickedTickets        = $lottery->pickedTickets?->map(fn($item) => $item['choosen_tickets'])->flatten()->toArray();
            $allChoosenTickets    = array_merge($cartTickets, $pickedTickets);
            $availableTickets     = collect(array_diff($allTickets, $allChoosenTickets));
            $randAvailableTickets = $availableTickets->random($request->quantity)->sort();

            $cart->lottery_id      = $lottery->id;
            $cart->quantity        = $request->quantity;
            $cart->choosen_tickets = $randAvailableTickets;
            $cart->save();

            $selectedTickets = $randAvailableTickets;
        }

        $data = [
            'randAvailableTickets' => $selectedTickets,
        ];
        return response()->json(['data' => $data]);
    }

    public function cartView() {
        $pageTitle = "Cart Details";

        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->with(['lottery', 'lottery.pickedTickets'])->orderByDesc('id')->get();
        } else {
            $cartItems = Cart::whereNotNull('session_id')->where('session_id', session('cartSessionId'))->orderByDesc('id')->with(['lottery', 'lottery.pickedTickets'])->get();
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->calculateSingleCartPrice();
        });

        return view('Template::cart_view', compact('pageTitle', 'cartItems', 'totalPrice'));
    }

    public function getCartCount() {
        $cartItemsCount = itemCount();
        return response()->json(['cartItemsCount' => $cartItemsCount]);
    }

    public function cartItemDelete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer|exists:carts,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $cartItem = Cart::where('id', $request->id)->first();
        $cartItem->delete();

        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->with('lottery')->get();
        } else {
            $cartItems = Cart::whereNotNull('session_id')->where('session_id', session('cartSessionId'))->with('lottery')->get();
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->calculateSingleCartPrice();
        });

        $data['success']     = 'Cart item removed successfully';
        $data['total_price'] = $totalPrice;
        return response()->json(['data' => $data]);
    }

    public function winners() {
        $pageTitle   = 'Winners List';
        $winners     = Winner::with('user:id,firstname,lastname,image', 'lottery:id,name,draw_date')->paginate(getPaginate(18));
        $page        = Page::where('tempname', activeTemplate())->where('slug', 'winners')->first();
        $sections    = $page->secs;
        $seoContents = $page->seo_content;
        $seoImage    = @$seoContents->image ? getImage(getFilePath('seo') . '/' . @$seoContents->image, getFileSize('seo')) : null;
        return view('Template::winners', compact('pageTitle', 'winners', 'sections', 'seoContents', 'seoImage'));

    }
}
