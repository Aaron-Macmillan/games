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

    
    Route::get('role-permissions', [RolePermissionController::class, 'index'])
    ->name('role-permissions.index');

Route::get('role-permissions/create', [RolePermissionController::class, 'create'])
    ->name('role-permissions.create');

Route::post('role-permissions', [RolePermissionController::class, 'store'])
    ->name('role-permissions.store');

Route::get('role-permissions/{role_id}/{permission_id}/edit', [RolePermissionController::class, 'edit'])
    ->name('role-permissions.edit');

Route::put('role-permissions/{role_id}/{permission_id}', [RolePermissionController::class, 'update'])
    ->name('role-permissions.update');

Route::delete('role-permissions/{role_id}/{permission_id}', [RolePermissionController::class, 'destroy'])
    ->name('role-permissions.destroy');


    
Route::get('user-roles', [UserRoleController::class, 'index'])
    ->name('user-roles.index');

Route::get('user-roles/create', [UserRoleController::class, 'create'])
    ->name('user-roles.create');

Route::post('user-roles', [UserRoleController::class, 'store'])
    ->name('user-roles.store');

Route::get('user-roles/{user_id}/{role_id}/edit', [UserRoleController::class, 'edit'])
    ->name('user-roles.edit');

Route::put('user-roles/{user_id}/{role_id}', [UserRoleController::class, 'update'])
    ->name('user-roles.update');

Route::delete('user-roles/{user_id}/{role_id}', [UserRoleController::class, 'destroy'])
    ->name('user-roles.destroy');


});