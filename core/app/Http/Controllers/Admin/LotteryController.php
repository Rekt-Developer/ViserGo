<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\PickedTicket;
use App\Models\User;
use App\Models\Winner;
use App\Rules\FileTypeValidate;
use App\Rules\InstantChooseVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LotteryController extends Controller {
    public function index() {
        $pageTitle = 'All Raffles';
        $lotteries = $this->getLotteries();
        return view('admin.lottery.index', compact('pageTitle', 'lotteries'));
    }
    public function live() {
        $pageTitle = 'Live Raffles';
        $lotteries = $this->getLotteries('live');
        return view('admin.lottery.index', compact('pageTitle', 'lotteries'));
    }
    public function drawn() {
        $pageTitle = 'Drawn Raffles';
        $lotteries = $this->getLotteries('drawn');
        return view('admin.lottery.index', compact('pageTitle', 'lotteries'));
    }

    protected function getLotteries($scope = null) {
        if ($scope) {
            $lotteries = Lottery::$scope();
        } else {
            $lotteries = Lottery::query();
        }
        return $lotteries->searchable(['name'])->with('competitions:id,name')->orderBy('id', 'desc')->paginate(getPaginate());
    }

    public function add($id = 0) {
        $images = [];

        if ($id) {
            $lottery   = Lottery::findOrFail($id);
            $pageTitle = 'Update Raffle';
            if (!empty($lottery->slider_images)) {
                foreach ($lottery->slider_images as $image) {
                    $img['id']  = $image;
                    $img['src'] = getImage(getFilePath('raffle') . '/' . $image);
                    $images[]   = $img;
                }
            }
        } else {
            $lottery   = null;
            $pageTitle = 'Add New Raffle';
        }
        return view('admin.lottery.add', compact('pageTitle', 'lottery', 'images'));
    }

    public function store(Request $request, $id = null) {
        $imgValidation = $id ? 'nullable' : 'required';

        $request->validate([
            'competition_id'           => 'required|integer|exists:competitions,id',
            'name'                     => 'required|string|max:255',
            'price'                    => 'required|numeric|gte:0',
            'num_of_tickets'           => 'required|integer|min:1',
            'max_buy'                  => 'required|integer|gt:0|lte:num_of_tickets',
            'starting_from'            => 'required|integer|gte:0',
            'segments'                 => 'required|integer|gt:0|lte:num_of_tickets',
            'instant_choose_variation' => ['required', 'max:40', 'string', new InstantChooseVariation($request->max_buy)],
            'description'              => 'required|string',
            'price_giving'             => 'required|string',
            'draw_date'                => 'required|date|after:' . now()->format('Y-m-d h:i A'),
            'num_of_winning_tickets'   => 'required|integer|lte:num_of_tickets',
            'images'                   => $imgValidation,
            'images.*'                 => [$imgValidation, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);

        if ($id) {
            $lottery         = Lottery::findOrFail($id);
            $currentDrawDate = Carbon::parse($lottery->draw_date)->format('Y-m-d h:i A');
            $newDrawDate     = Carbon::parse($request->draw_date)->format('Y-m-d h:i A');

            if ($currentDrawDate > $newDrawDate) {
                $notify[] = ['error', 'Draw time must be greater than the current draw time'];
                return back()->withNotify($notify);
            }

            if ($request->num_of_tickets < $lottery->num_of_tickets) {
                $notify[] = ['error', 'Number of tickets cannot be less than the current value'];
                return back()->withNotify($notify);
            }

            if ($request->num_of_tickets > $lottery->num_of_tickets) {
                $extraTickets = $request->num_of_tickets - $lottery->num_of_tickets;

                $lottery->num_of_tickets = $request->num_of_tickets;
                $lottery->num_of_available_tickets += $extraTickets;
            }

            $imageToRemove = $request->old ? array_values(removeElement($lottery->slider_images, $request->old)) : $lottery->slider_images;

            if ($imageToRemove != null && count($imageToRemove)) {
                foreach ($imageToRemove as $singleImage) {
                    fileManager()->removeFile(getFilePath('raffle') . '/' . $singleImage);
                }
                $lottery->slider_images = removeElement($lottery->slider_images, $imageToRemove);
            }
            $notification = 'Lottery updated successfully';

        } else {
            $lottery = new Lottery();

            $lottery->num_of_tickets           = $request->num_of_tickets;
            $lottery->num_of_available_tickets = $request->num_of_tickets;
            $lottery->starting_from            = $request->starting_from;

            $notification = 'Lottery created successfully';
        }

        $sliderImage = $id ? $lottery->slider_images : [];

        if ($request->hasFile('images')) {
            foreach ($request->images as $singleImage) {
                try {
                    $sliderImage[] = fileUploader($singleImage, getFilePath('raffle'), getFileSize('raffle'), null, getFileThumbSize('raffle'));
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Couldn\'t upload your image'];
                    return back()->withNotify($notify);
                }
            }
        }

        $purifier = new \HTMLPurifier();

        $lottery->competition_id           = $request->competition_id;
        $lottery->name                     = $request->name;
        $lottery->slug                     = slug($request->name);
        $lottery->price                    = $request->price;
        $lottery->max_buy                  = $request->max_buy;
        $lottery->segments                 = $request->segments;
        $lottery->instant_choose_variation = $request->instant_choose_variation;
        $lottery->description              = htmlspecialchars_decode($purifier->purify($request->description));
        $lottery->price_giving             = htmlspecialchars_decode($purifier->purify($request->price_giving));
        $lottery->draw_date                = Carbon::parse($request->draw_date)->format('Y-m-d H:i:s');
        $lottery->num_of_winning_tickets   = $request->num_of_winning_tickets;
        $lottery->slider_images            = $sliderImage;
        $lottery->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function updateStatus($id) {
        return Lottery::changeStatus($id);
    }

    public function winners() {
        $pageTitle = 'Declared Raffles';
        $winners   = Winner::with('user', 'lottery')->searchable(['lottery:name', 'user:username,firstname,lastname', 'ticket_number'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.lottery.winners_detail', compact('pageTitle', 'winners'));
    }
    public function winnerDetail($id) {
        $user      = User::findOrFail($id);
        $pageTitle = 'Winner Detail - ' . $user->username;
        $winners   = Winner::where('user_id', $id)->searchable(['lottery:name', 'user:username,firstname,lastname', 'ticket_number'])->with('user', 'lottery')->paginate(getPaginate());
        return view('admin.lottery.winners_detail', compact('winners', 'pageTitle'));
    }

    public function soldTickets() {
        $pageTitle = 'Sold Tickets';
        $tickets   = PickedTicket::with('user', 'lottery')->searchable(['lottery:name', 'user:username,firstname,lastname'], false)->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.lottery.sold_tickets', compact('pageTitle', 'tickets'));
    }
}
