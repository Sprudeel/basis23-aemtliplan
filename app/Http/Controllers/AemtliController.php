<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Models\Aemtli;
use App\Models\Group;

class AemtliController extends Controller
{
    public function index() {
        return Inertia::render('Aemtli/Aemtli', [
            'aemtlis' => Aemtli::all(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:App\Models\Aemtli,name',
        ]);

        $aemtli = Aemtli::create([
            'name' => $request->name,
        ]);

        return redirect(route('aemtli.index'));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255|unique:App\Models\Aemtli,name',
        ]);

        $aemtli = Aemtli::where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        $aemtli = Aemtli::find($request->id);
        $aemtli->delete();

        return redirect()->back();
    }

    public function change(Request $request) {
        $group = Group::where('name', $request->group)->first() ? Group::where('name', $request->group)->first()->id : 0;

        $aemtli = Aemtli::where('name', $request->aemtli)->update([
            'group' => $group,
        ]);
    }
}
