<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StatisticController;

Route::redirect('/', '/login')->name('redirectByRole');

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function() {
        Route::redirect('/', '/admin/users')->name('admin');
        Route::resource('users', UserController::class)->except(['show', 'create']);
        Route::resource('menus', MenuController::class)->except(['show', 'create']);
        Route::resource('tables', TableController::class)->except(['show', 'create']);
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    });

    Route::group(['middleware' => 'cashier', 'prefix' => 'cashier'], function() {
        Route::redirect('/', '/cashier/add-transaction')->name('cashier');
        Route::resource('transactions', TransactionController::class)->except(['create']);
        Route::get('/transactions/{transaction}/print', [TransactionController::class, 'showInvoice'])->name('transactions.print');
        Route::get('/add-transaction', [TransactionController::class, 'create'])->name('transactions.create');
        Route::get('/tables', [TableController::class, 'editStatus'])->name('tables.editStatus');
        Route::put('/tables/{table}', [TableController::class, 'updateStatus'])->name('tables.updateStatus');
    });

    Route::group(['middleware' => 'manager', 'prefix' => 'manager'], function() {
        Route::redirect('/', '/manager/statistics')->name('manager');
        Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
        Route::get('/transactions', [TransactionController::class, 'indexManager'])->name('transactions-manager.index');
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs-manager.index');
        Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions-manager.show');
    });
});
