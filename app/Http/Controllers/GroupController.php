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
            'name' => 'required|string|max:255|unique:App\Models\Group,name',
            'participants' => 'required|array|min:1',
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

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255|unique:App\Models\Group,name',
            'participants' => 'required|array|min:1',
        ]);

        $group = Group::where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        $delete = Participant::where('group', $request->id)->delete();

        foreach($request->participants as $participant) {
            Participant::create([
                'name' => $participant,
                'group' => $request->id,
            ]);
        }
        return redirect()->back();
    }

    public function destroy(Request $request) {
        $group = Group::find($request->id);
        $group->delete();

        $delete = Participant::where('group', $request->id)->delete();

        return redirect()->back();
    }
}
