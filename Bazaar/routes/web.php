<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\NewAdvertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// falback route
Route::get('/c/{company}', [CompanyController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/generate-contract-pdf', 'App\Http\Controllers\ContractController@generatePDF');
Route::post('/adverts/{advert}/bid', [NewAdvertController::class, 'bid'])->name('adverts.bid')->middleware(['auth', 'verified']);
Route::resource('/adverts', NewAdvertController::class)->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/favorite', [NewAdvertController::class, 'favorite'])->name('adverts.favorite')->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/unfavorite', [NewAdvertController::class, 'unfavorite'])->name('adverts.unfavorite')->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/isFavorite', [NewAdvertController::class, 'isFavorite'])->name('adverts.isFavorite')->middleware(['auth', 'verified']);
Route::post('/adverts/rate', [NewAdvertController::class, 'rate'])->name('adverts.rate')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
