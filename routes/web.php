<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin|klant'])->group(function () {
Route::get('games', [App\Http\Controllers\GameController::class, 'index']);
Route::get('games/show/{id}', [App\Http\Controllers\GameController::class, 'show']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('games/create', [App\Http\Controllers\GameController::class, 'create']);
Route::post('games/store', [App\Http\Controllers\GameController::class, 'store']);
Route::get('games/edit/{id}', [App\Http\Controllers\GameController::class, 'edit']);
Route::post('games/update/{id}', [App\Http\Controllers\GameController::class, 'update']);
Route::post('games/destroy/{id}', [App\Http\Controllers\GameController::class, 'destroy']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserRoleController;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('permissions', PermissionController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('role-permissions', RolePermissionController::class);

    Route::resource('user-roles', UserRoleController::class);

});