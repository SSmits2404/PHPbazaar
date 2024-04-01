<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\NewAdvertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
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

// falback route


Route::get('/dashboard', [NewAdvertController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/adverts/{advert}/bid', [NewAdvertController::class, 'bid'])->name('adverts.bid')->middleware(['auth', 'verified']);
Route::get('/adverts/create/{type}', [NewAdvertController::class, 'create'])->name('adverts.create')->middleware(['auth', 'verified']);
Route::resource('/adverts', NewAdvertController::class)->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/favorite', [NewAdvertController::class, 'favorite'])->name('adverts.favorite')->middleware(['auth', 'verified']);
Route::get('/favorites', [NewAdvertController::class, 'showfavorites'])->name('favorites')->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/unfavorite', [NewAdvertController::class, 'unfavorite'])->name('adverts.unfavorite')->middleware(['auth', 'verified']);
Route::get('/adverts/{advert}/isFavorite', [NewAdvertController::class, 'isFavorite'])->name('adverts.isFavorite')->middleware(['auth', 'verified']);
Route::post('/adverts/rate', [NewAdvertController::class, 'rate'])->name('adverts.rate')->middleware(['auth', 'verified']);
Route::post('/adverts/{advert}/buy', [NewAdvertController::class, 'buy'])->name('adverts.buy')->middleware(['auth', 'verified']);
Route::post('/adverts/bought', [NewAdvertController::class, 'bought'])->name('adverts.bought')->middleware(['auth', 'verified']);
Route::post('advert/{advert}/rent', [NewAdvertController::class, 'rent'])->name('adverts.rent')->middleware(['auth', 'verified']);
Route::get('/u/buy-history', [NewAdvertController::class, 'showbought'])->name('adverts.bought')->middleware(['auth', 'verified']);
Route::get('/ownRent', [NewAdvertController::class, 'ownRent'])->name('ownRent');
Route::get('/rented', [NewAdvertController::class, 'rented'])->name('rented');
Route::get('/expiry', [NewAdvertController::class, 'expiry'])->name('expiry');
Route::get('/pickUp', [NewAdvertController::class, 'pickUp'])->name('rented.pickUp');
Route::get('/return', [NewAdvertController::class, 'return'])->name('return');
Route::post('/return', [NewAdvertController::class, 'returnItem'])->name('rented.returnItem');
Route::get('/repair/{advert}', [NewAdvertController::class, 'repair'])->name('expiry.repair');

Route::get('/c', [CompanyController::class, 'overview'])->middleware(['auth', 'verified']);
Route::get('/c/{company}', [CompanyController::class, 'view'])->name('company')->middleware(['auth', 'verified']);
Route::post('/company/rate', [CompanyController::class, 'rate'])->name('company.rate');
Route::get('/createcompany', [CompanyController::class, 'create'])->name('createcompany')->middleware(['auth', 'verified']);
Route::post('/createcompany', [CompanyController::class, 'store'])->name('createcompany.store')->middleware(['auth', 'verified']);

Route::get('/contract-upload', [ContractController::class, 'getcontractupload'])->name('contract.upload');
Route::post('/contract-store', [ContractController::class, 'storecontract'])->name('contract.store');
Route::get('/generate-contract-pdf', [ContractController::class, 'generatePDF'])->name('generate-contract-pdf')->middleware(['auth', 'verified']);
Route::get('/generate-unnaproved-pdf', [ContractController::class, 'getunapprovedpdf'])->name('contract.unapproved')->middleware(['auth', 'verified']);
Route::get('/contract-approve', [ContractController::class, 'approvepdf'])->name('contract.approve')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('profile/generateapitoken', [ProfileController::class, 'generateAPIKey'])->name('profile.generateApiToken');
    Route::post('profile/revokeapitoken', [ProfileController::class, 'revokeAPIKey'])->name('profile.revokeApiToken');
});
require __DIR__.'/auth.php';
