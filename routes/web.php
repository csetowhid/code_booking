<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('tables',TableController::class);
Route::get('bookings/index',[BookingController::class,'index'])->name('bookings.index');
Route::get('bookings/create/{id}',[BookingController::class,'create'])->name('bookings.create');
Route::post('bookings/store',[BookingController::class,'store'])->name('bookings.store');
