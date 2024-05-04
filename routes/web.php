<?php

use App\Livewire\RP\PermissionManager;
use App\Livewire\RP\RoleManager;
use App\Livewire\RP\UserManager;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/roles', RoleManager::class)->name('roles');
Route::get('/permissions', PermissionManager::class)->name('permissions');
Route::get('/users', UserManager::class)->name('users');

Route::get('/test', function () {
    return "You have permission to access this test content!";
})->middleware('can:create-post');
Route::get('/permissions-test', function () {
    return view('permissions-test');
})->middleware('auth');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
