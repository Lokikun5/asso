<?php

namespace App\Http\Controllers;
use App\Models\Article;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Affiche les articles sur la page d'accueil
    public function index()
    {
        $articles = Article::with('media')->latest()->take(6)->get(); // Les 6 derniers articles
        return view('articles.index', compact('articles'));
    }

    // Affiche un article en détail
    public function show($slug)
    {
        $article = Article::with('media')->where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }
}
