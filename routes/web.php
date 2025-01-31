<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;
use App\Models\Article;

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
Route::get('/Les-activites-prevues', function(){ return view('activity');})->name('activity');
Route::get('/Public-cible', function(){ return view('target');})->name('target');

Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show');

Route::get('/test-error', function () {
    abort(500);
});


Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(route('welcome')))
        ->add(Url::create(route('objectif')))
        ->add(Url::create(route('activity')))
        ->add(Url::create(route('target')));

        foreach (Article::all() as $article) {
            $sitemap->add(Url::create(route('articles.show', ['slug' => $article->slug])));
        }

        return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');

});