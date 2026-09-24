<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\Account\PropertyController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/account/profile', [ProfileController::class, 'edit'])
        ->name('account.profile');

    // Properties
    Route::get('/account/properties/create', [PropertyController::class, 'create'])
        ->name('account.properties.create');

    Route::post('/account/properties', [PropertyController::class, 'store'])
        ->name('account.properties.store');

    Route::get('/account/properties', [PropertyController::class, 'index'])
        ->name('account.properties.index');
});