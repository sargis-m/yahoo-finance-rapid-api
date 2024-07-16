<?php

use App\Http\Controllers\StockController;
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
    return redirect()->route('stocks.index');
});

Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/{symbol}', [StockController::class, 'show'])->name('stocks.show');
