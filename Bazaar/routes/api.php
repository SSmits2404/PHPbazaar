<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewAdvertController;
use App\Http\Controllers\CompanyController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/adverts/{advert}/currentbid', [NewAdvertController::class, 'currentbid']);
Route::post('/adverts/{id}/bid', [NewAdvertController::class, 'bid'])->middleware('auth:sanctum');

route::get('/c/{company}/adverts', [CompanyController::class, 'index'])->middleware(['auth:sanctum', 'verified']);