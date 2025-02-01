<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Définition des routes principales du site.
|
*/

// ✅ Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// ✅ Pages statiques
Route::get('/Nos-objectif', fn() => view('objectif'))->name('objectif');
Route::get('/Les-activites-prevues', fn() => view('activity'))->name('activity');
Route::get('/Public-cible', fn() => view('target'))->name('target');

// ✅ Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Tableau de bord et gestion des articles (PROTÉGÉ PAR `auth` & `admin`)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ✅ Routes de gestion des articles
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticlesController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->name('articles.destroy');
});

// ✅ Routes publiques des articles (🔥 DERNIÈRE ROUTE DYNAMIQUE)
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show'); // 🔥 TOUJOURS À LA FIN !

// ✅ Génération du sitemap.xml
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

// ✅ Formulaire de contact
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
