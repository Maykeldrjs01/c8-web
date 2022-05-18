<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubscribersController as AdminSubsController;
use App\Http\Controllers\User\SubscribersController as UserSubsController;
use App\Http\Controllers\LoginController;

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

Route::get('/home',[LoginController::class, 'index'])->middleware('auth');


Route::group(['middleware' => 'auth'], function(){

    /**
     * Group the admin privileges with the is_admin middleware
     */

    Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'as' => 'admin.'],
        function () {
            Route::get('/dashboard', [AdminSubsController::class, 'index'])
            ->name('dashboard.index');

            Route::post('/dashboard/filtered', [AdminSubsController::class, 'filters'])
            ->name('dashboard.filters');

           Route::post('/dashboard/groups/', [AdminSubsController::class, 'showGroup'])
            ->name('dashboard.groups');

            Route::get('/subscribers', [AdminSubsController::class, 'create'])
            ->name('subscribers.index');

            Route::post('/subscribers', [AdminSubsController::class, 'store'])
            ->name('subscribers.store');

            Route::post('/subscribers/edit', [AdminSubsController::class, 'edit'])
            ->name('subscribers.edit');

            Route::put('/subscribers/update/{name}/{group}', [AdminSubsController::class, 'update'])
            ->name('subscribers.update');

            Route::delete('/subscribers/delete', [AdminSubsController::class, 'destroy'])
            ->name('subscribers.delete');
        }
    );

    /**
     * User group privileges and accessibles
     */

    Route::group(['prefix' => 'user', 'as' => 'user.'],
        function () {
            Route::get('/dashboard', [UserSubsController::class, 'index'])
            ->name('dashboard.index');

            Route::post('/dashboard/filtered', [UserSubsController::class, 'filters'])
            ->name('dashboard.filters');

           Route::post('/dashboard/groups/', [AdminSubsController::class, 'showGroup'])
            ->name('dashboard.groups');

            Route::get('/subscribers/view/', [UserSubsController::class, 'show'])
            ->name('subscribers.view');
        }
    );
});



require __DIR__.'/auth.php';