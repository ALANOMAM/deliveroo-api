<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//per gestire tante rotte insieme sotto lo stesso middleware
//e raggrupparle con elementi comuni 
Route::middleware(['auth', 'verified'])
    ->name('admin.') // i loro nomi inizino tutti con "admin.
    ->prefix('admin') // tutti i loro url inizino con "admin/"
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [DashboardController::class, 'users'])->name('users');

        //creazione e salvataggio dei dati sia dell'utente che del ristorante
        // Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        // Route::post('/register', [RegisteredUserController::class, 'store']);

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/restaurants', RestaurantController::class);

        //DishController route
        Route::resource('/dishes', DishController::class);

        //OrderController route
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

        //StatsController route
        Route::get('/order-stats',[StatsController::class, 'OrderChart']);

        //StatsController route
        // Route::get('/order-stats2',[StatsController::class, 'OrderChart2']);

    });
