<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('pages.auth.login');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::resource('articles', ArticleController::class);
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::post('/{article}/publish', [ArticleController::class, 'publish'])->name('publish');
    });
});
