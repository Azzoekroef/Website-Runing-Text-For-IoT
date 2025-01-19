<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WiFiConfigController;
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
    return view('welcome');
});

Route::get('/display', function () {
    return view('display');
});

Route::get('/viewmodetext', function () {
    return view('viewmodetext');
});

Route::get('/wifi-form', [WiFiConfigController::class, 'index'])->name('wifi');
Route::post('/wifi-config', [WiFiConfigController::class, 'store'])->name('wifi-config');