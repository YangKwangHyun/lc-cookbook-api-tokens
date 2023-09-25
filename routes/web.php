<?php

use App\Http\Controllers\ProfileController;
use App\Models\Repo;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/my-repos', function () {
    return view('repos.index', [
        'repos' => auth()->user()->repos()->latest()->get(),
    ]);
})->middleware('auth')->name('my-repos');

Route::get('/personal-access-tokens', function () {
    return view('personal-access-tokens');
})->middleware('auth')->name('personal-access-tokens');

Route::post('/personal-access-tokens', function (Request $request) {
    $request->validate([
        'token_name' => 'required',
    ]);

    $abilities = [];

    if($request->create) {
        array_push($abilities, 'create');
    }

    if($request->delete) {
        array_push($abilities, 'delete');
    }

    $token = $request->user()->createToken($request->token_name, $abilities);

    return back()->with('success_message', 'Token was created, make sure to copy this: '.$token->plainTextToken);
})->middleware('auth');

Route::get('/repos/create', function () {
    return view('repos.create');
})->middleware('auth')->name('repos.create');

Route::get('/repos/{repo:name}', function (Repo $repo) {
    return view('repos.show', [
        'repo' => $repo,
    ]);
});

Route::post('/repos', function (Request $request) {
    $request->validate([
        'name' => 'required|alpha_dash|unique:repos|min:3',
        'description' => 'required|min:3',
    ]);

    Repo::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect('/my-repos')->with('success_message', 'Repo was created!');
})->middleware('auth');

Route::delete('/repos/{repo}', function (Repo $repo) {
    abort_if($repo->user_id !== auth()->id(), 401);

    $repo->delete();

    return redirect('/my-repos')->with('success_message', 'Repo was deleted!');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
