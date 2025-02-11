<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstitutionPartnerController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PrivateSectorCompanyController;
use App\Http\Controllers\SectorUtilitiesController;
use App\Models\Article;
use App\Models\Partner;
use App\Models\InstitutionPartner;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// ✅ Pages statiques
Route::get('/Nos-programmes', fn() => view('programmes'))->name('programmes');
Route::get('/Les-activites-prevues', fn() => view('activity'))->name('activity');
Route::get('/Public-cible', fn() => view('target'))->name('target');

// ✅ Routes publiques des partenaires (Front)
Route::get('/Nos-partenaires', [PartnerController::class, 'index'])->name('partenaires');
Route::get('/Nos-partenaires/{slug}', [PartnerController::class, 'show'])->name('partenaire.show');

// ✅ Routes publiques des établissement partenaires (Front)
Route::get('/etablissements-partenaires', [InstitutionPartnerController::class, 'index'])->name('etablissements.index');

Route::get('/entreprises-du-secteur-privé', [PrivateSectorCompanyController::class, 'index'])->name('private.companies');
Route::get('/services-publics', [SectorUtilitiesController::class, 'index'])->name('sector.utilities');

// ✅ Routes publiques des podcast (Front)
Route::get('/podcasts', [PodcastController::class, 'index'])->name('podcasts.index');
Route::get('/podcasts/{slug}', [PodcastController::class, 'show'])->name('podcasts.show');


// ✅ Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Routes publiques des articles
Route::get('/articles', [ArticlesController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show'); // 🔥 TOUJOURS À LA FIN !

// ✅ Redirection pour `/dashboard`
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
});

// ✅ 🛠️ Tableau de bord & Gestion des contenus (Back-office)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // 🏠 Tableau de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ✅ Gestion des Articles
    Route::get('/articles', [ArticlesController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [ArticlesController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{id}/edit', [ArticlesController::class, 'edit'])->name('admin.articles.edit');
    Route::put('/articles/{id}', [ArticlesController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{id}', [ArticlesController::class, 'destroy'])->name('admin.articles.destroy');
    Route::patch('/articles/{id}/toggle', [ArticlesController::class, 'toggle'])->name('admin.articles.toggle');

    // ✅ Gestion des Partenaires
    Route::get('/partenaires', [PartnerController::class, 'adminIndex'])->name('admin.partenaires.index');
    Route::get('/partenaires/create', [PartnerController::class, 'create'])->name('admin.partenaires.create');
    Route::post('/partenaires', [PartnerController::class, 'store'])->name('admin.partenaires.store');
    Route::get('/partenaires/{id}/edit', [PartnerController::class, 'edit'])->name('admin.partenaires.edit');
    Route::put('/partenaires/{id}', [PartnerController::class, 'update'])->name('admin.partenaires.update');
    Route::patch('/admin/partenaires/{id}/toggle', [PartnerController::class, 'toggleActive'])->name('admin.partenaires.toggle');
    Route::delete('/partenaires/{id}', [PartnerController::class, 'destroy'])->name('admin.partenaires.destroy');

    Route::get('/institution-partners', [InstitutionPartnerController::class, 'adminIndex'])->name('admin.institution-partners.index');
    Route::get('/institution-partners/create', [InstitutionPartnerController::class, 'create'])->name('admin.institution-partners.create');
    Route::post('/institution-partners', [InstitutionPartnerController::class, 'store'])->name('admin.institution-partners.store');
    Route::get('/institution-partners/{id}/edit', [InstitutionPartnerController::class, 'edit'])->name('admin.institution-partners.edit');
    Route::put('/institution-partners/{id}', [InstitutionPartnerController::class, 'update'])->name('admin.institution-partners.update');
    Route::delete('/institution-partners/{id}', [InstitutionPartnerController::class, 'destroy'])->name('admin.institution-partners.destroy');
    Route::patch('/institution-partners/{id}/toggle', [InstitutionPartnerController::class, 'toggleActive'])->name('admin.institution-partners.toggle');

    Route::post('/admin/articles/upload-media', [ArticleController::class, 'storeMedia'])->name('admin.articles.storeMedia');
    Route::delete('/admin/articles/delete-media/{id}', [ArticlesController::class, 'deleteMedia'])->name('admin.articles.deleteMedia');

    Route::get('/podcasts', [PodcastController::class, 'adminIndex'])->name('admin.podcasts.index');
    Route::get('/podcasts/create', [PodcastController::class, 'create'])->name('admin.podcasts.create');
    Route::post('/podcasts', [PodcastController::class, 'store'])->name('admin.podcasts.store');
    Route::get('/podcasts/{id}/edit', [PodcastController::class, 'edit'])->name('admin.podcasts.edit');
    Route::put('/podcasts/{id}', [PodcastController::class, 'update'])->name('admin.podcasts.update');
    Route::patch('/podcasts/{id}/toggle', [PodcastController::class, 'toggleActive'])->name('admin.podcasts.toggle');
    Route::delete('/podcasts/{id}', [PodcastController::class, 'destroy'])->name('admin.podcasts.destroy');
    Route::delete('/podcasts/delete-media/{id}', [PodcastController::class, 'deleteMedia'])->name('admin.podcasts.deleteMedia');

    Route::get('/profile', [AdminUserController::class, 'profile'])->name('admin.profile');
    Route::post('/profile/update', [AdminUserController::class, 'updateProfile'])->name('admin.profile.update');
    
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create'); 
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');


});

// ✅ 🔍 Génération du `sitemap.xml` (🚀 Seules les routes publiques doivent être incluses)
Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(route('welcome')))
        ->add(Url::create(route('programmes')))
        ->add(Url::create(route('activity')))
        ->add(Url::create(route('target')))
        ->add(Url::create(route('articles.index')))
        ->add(Url::create(route('partenaires')))
        ->add(Url::create(route('etablissements.index')))
        ->add(Url::create(route('private.companies')))
        ->add(Url::create(route('sector.utilities')))
        ->add(Url::create(route('podcasts.index')));
        

    foreach (Article::where('active', true)->get() as $article) {
        $sitemap->add(Url::create(route('articles.show', ['slug' => $article->slug])));
    }

    foreach (Partner::where('active', true)->get() as $partner) {
        $sitemap->add(Url::create(route('partenaire.show', ['slug' => $partner->slug])));
    }

    foreach (Partner::where('active', true)->get() as $podcast) {
        $sitemap->add(Url::create(route('podcasts.show', ['slug' => $podcast->slug])));
    }

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');
});

// ✅ Formulaire de contact
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/upload-image', function (Request $request) {
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('uploads', 'public'); // ✅ Stockage dans `/storage/app/public/uploads`
        return response()->json(['location' => asset('storage/' . $path)]);
    }
    return response()->json(['error' => 'Aucune image détectée'], 400);
})->name('upload.image');

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');