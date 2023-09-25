<?php

use App\Models\Repo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/repos', function () {
    return Repo::with('user:id,name')->latest()->get();
});

Route::post('/user/repos', function (Request $request) {
    $request->validate([
        'name'        => 'required|alpha_dash|unique:repos|min:3',
        'description' => 'required|min:3',
    ]);

    return Repo::create([
        'user_id'     => auth()->id(),
        'name'        => $request->name,
        'description' => $request->description,
    ]);
})->middleware(['auth:sanctum', 'abilities:create']);

Route::delete('/repos/{repo:name}', function (Repo $repo) {
    abort_if($repo->user_id !== auth()->id(), 401);

    $repo->delete();

    return response()->json('Repo Deleted', 204);
})->middleware(['auth:sanctum', 'abilities:delete']);
