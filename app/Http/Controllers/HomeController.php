<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Podcast;

class HomeController extends Controller
{
    public function index()
    {
         
        $articles = Article::with('media')->where('active', true)->latest()->take(6)->get();
        $podcasts = Podcast::where('active', true)->latest()->take(6)->get();

        // Retourner la vue avec les articles
        return view('welcome', compact('articles','podcasts'));
    }
}
