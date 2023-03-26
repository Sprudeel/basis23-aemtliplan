<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AemtliController;
use App\Http\Controllers\GroupController;
use App\Models\Aemtli;
use App\Models\Group;
use App\Models\Participant;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
            'groups' => Group::with('participants')->orderBy('created_at', 'desc')->get(),
            'aemtlis' => Aemtli::with('group')->orderBy('created_at', 'desc')->get(),
        ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /**
     * Ämtli
     */
    Route::get('/aemtli', [AemtliController::class, 'index'])->name('aemtli.index');
    Route::post('/aemtli/store', [AemtliController::class, 'store'])->name('aemtli.store');
    Route::post('/aemtli/update', [AemtliController::class, 'update'])->name('aemtli.update');
    Route::post('/aemtli/destroy/{id}', [AemtliController::class, 'destroy'])->name('aemtli.destroy');

     /**
     * Groups
     */
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::post('/group/store', [GroupController::class, 'store'])->name('group.store');
    Route::post('/group/update', [GroupController::class, 'update'])->name('group.update');
    Route::post('/group/destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');

    Route::post('aemtli/change', [AemtliController::class, 'change'])->name('aemtli.change');

});

require __DIR__.'/auth.php';
