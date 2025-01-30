<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/Nos-objectif', function(){ return view('objectif');})->name('objectif');
Route::get('/Les-activités-prévues', function(){ return view('activity');})->name('activity');
Route::get('/Public-cible', function(){ return view('target');})->name('target');

Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show');

Route::get('/test-error', function () {
    abort(500);
});