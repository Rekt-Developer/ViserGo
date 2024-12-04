<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller {
    public function index() {
        $pageTitle    = 'All Competitions';
        $competitions = Competition::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.competition.index', compact('pageTitle', 'competitions'));
    }

    public function store(Request $request, $id = null) {
        $request->validate([
            'name' => 'required|string|max:40|unique:competitions,name,' . $id,
        ]);

        if ($id) {
            $competition  = Competition::findOrFail($id);
            $notification = 'Competition updated successfully';
        } else {
            $competition  = new Competition();
            $notification = 'Competition added successfully';
        }

        $competition->slug = slug($request->name);
        $competition->name = $request->name;
        $competition->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function status($id) {
        return Competition::changeStatus($id);
    }
}
