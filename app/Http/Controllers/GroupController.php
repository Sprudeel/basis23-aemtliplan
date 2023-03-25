<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Models\Aemtli;
use App\Models\Group;
use App\Models\Participant;

class GroupController extends Controller
{
    public function index() {
        return Inertia::render('Groups/Groups', [
            'groups' => Group::with('aemtli', 'participants')->get(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'participants' => 'required',
        ]);

        $group = Group::create([
            'name' => $request->name,
        ]);

        foreach($request->participants as $participant) {
            Participant::create([
                'name' => $participant,
                'group' => $group->id,
            ]);
        }

        return redirect()->back();
    }
}
