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

Route::get('dashboard/{filter}', [SubscribersController::class, 'filters'])
->middleware(['auth'])->name('dashboard.filter');

Route::get('dashboard', [SubscribersController::class, 'index'])
->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
