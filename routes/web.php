<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscribersController;

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
    return view('auth.login');
});

// Route::get('/test', );



Route::middleware('auth')->group(function () {

    Route::get('dashboard', [SubscribersController::class, 'index'])
    ->name('dashboard.index');

    Route::post('dashboard/filtered', [SubscribersController::class, 'filters'])
    ->name('dashboard.filters');

    Route::get('subscribers', [SubscribersController::class, 'create'])
    ->name('subscribers.index');

    Route::post('subscribers', [SubscribersController::class, 'store'])
    ->name('subscribers.store');

    Route::post('subscribers/edit/{group}/{name}', [SubscribersController::class, 'edit'])
    ->name('subscribers.edit');

    Route::put('subscribers/edit/{group}/{name}', [SubscribersController::class, 'update'])
    ->name('subscribers.update');
});
require __DIR__.'/auth.php';
