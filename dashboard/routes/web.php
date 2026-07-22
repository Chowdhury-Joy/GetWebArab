<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('clients', ClientController::class)->except(['destroy']);
    Route::get('/earnings', [EarningsController::class, 'index'])->name('earnings');

    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('partners', PartnerController::class)->except(['destroy']);
        Route::get('clients', [ClientController::class, 'all'])->name('clients.index');
        Route::resource('services', ServiceController::class)->only(['index', 'update']);
        Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::patch('settings', [SettingsController::class, 'update'])->name('settings.update');

        // V2 Payout Tracking
        Route::get('periods', [\App\Http\Controllers\Admin\PeriodController::class, 'index'])->name('periods.index');
        Route::post('periods/{period}/close', [\App\Http\Controllers\Admin\PeriodController::class, 'close'])->name('periods.close');
        
        Route::get('periods/{period}/payouts', [\App\Http\Controllers\Admin\PayoutController::class, 'index'])->name('payouts.index');
        Route::post('periods/{period}/payouts/{partner}', [\App\Http\Controllers\Admin\PayoutController::class, 'store'])->name('payouts.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
