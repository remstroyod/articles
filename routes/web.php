<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('profile')->name('user.')->group(function ()
{

    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
    Route::delete('/{user}', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('destroy');

});


Route::middleware(['auth', 'can:isAdmin'])->prefix('articles')->name('articles.')->group(function ()
{

    Route::get('/create', [\App\Http\Controllers\ArticleController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\ArticleController::class, 'store'])->name('store');

    Route::get('/edit/{article}', [\App\Http\Controllers\ArticleController::class, 'show'])->middleware('unsplashUpdate')->name('edit');
    Route::post('/update/{article}', [\App\Http\Controllers\ArticleController::class, 'update'])->name('update');
    Route::delete('/destroy/{article}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->name('destroy');

});
