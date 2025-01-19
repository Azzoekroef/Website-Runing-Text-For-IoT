<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// routes/api.php
use App\Http\Controllers\ModeTextController;

use App\Http\Controllers\WiFiConfigController;
use App\Http\Controllers\DisplayModeController;

Route::get('/modes', [DisplayModeController::class, 'getModes']);
Route::post('/modes', [DisplayModeController::class, 'updateModes']);
Route::get('/mode', [ModeTextController::class, 'getModesText']);
Route::post('/mode', [ModeTextController::class, 'updateModesText']);

Route::get('/wifi-config-json', [WiFiConfigController::class, 'getWiFiConfigJson']);



use App\Http\Controllers\ModeController;

Route::get('/modest', [ModeController::class, 'index']);
Route::post('/modest', [ModeController::class, 'store']);
Route::get('/modest/{id}', [ModeController::class, 'show']);
Route::put('/modest/{id}', [ModeController::class, 'update']);
Route::delete('/modest/{id}', [ModeController::class, 'destroy']);


Route::get('/manage-modest', [ModeController::class, 'manageModesView']);



