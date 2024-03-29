<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// Route::prefix('github')->name('socialite.')->controller(SocialiteController::class)->group(function(){
//     // send to provider
//     Route::get('/login','login')->name('login');
//     // recive from provider
//     Route::get('/redirect','redirect')->name('redirect');

// });


// Route::prefix('dribbble')->name('dribbble.')->controller(SocialiteController::class)->group(function(){
//     // send to provider
//     Route::get('/login','dribbble_login')->name('login');
//     // recive from provider
//     Route::get('/redirect','dribbble_redirect')->name('redirect');

// });

// refactor
Route::name('socialite.')->controller(SocialiteController::class)->group(function () {
    Route::get('{provider}/login', 'login')->name('login');
    Route::get('{provider}/redirect', 'redirect')->name('redirect');
});
