<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProfileController;
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
Route::get('/advert/{advert}', [AdvertController::class, 'index'])->name('advert')->fallback('adverts');
Route::get('/adverts', [AdvertController::class, 'overview'])->;
Route::get('/adverts/create', [AdvertController::class, 'create'])->name('adverts.create');	
Route::post('/adverts', [AdvertController::class, 'store'])->name('adverts.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
