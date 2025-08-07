<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\ShortLinkController;


Route::get('/login', [UserController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/', fn() => redirect()->route('sites.index'));
    Route::resource('sites', SiteController::class)->only(['index', 'create', 'store']);
    Route::resource('short-links', ShortLinkController::class)->only(['index', 'create', 'store', 'destroy']);
});
Route::get('/{code}', [ShortLinkController::class, 'redirect'])->name('short-links.redirect');
Route::get('/{code}/details', [ShortLinkController::class, 'details'])->name('short-links.details');
Route::post('/generate', [ShortLinkController::class, 'generate']);



//Route::post('/generate', [ShortLinkController::class, 'generate']);
//Route::post('/encrypt', [ShortLinkController::class, 'encrypt']);
//Route::get('/{code}', [ShortLinkController::class, 'redirect']);
Route::get('/', function () {
    return view('welcome');
});
