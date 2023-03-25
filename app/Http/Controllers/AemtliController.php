<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Models\Aemtli;

class AemtliController extends Controller
{
    public function index() {
        return Inertia::render('Aemtli/Aemtli', [
            'aemtlis' => Aemtli::all(),
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $aemtli = Aemtli::create([
            'name' => $request->name,
        ]);

        return redirect(route('aemtli.index'));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
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
}
