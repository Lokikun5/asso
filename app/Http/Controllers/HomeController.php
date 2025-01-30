<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        
        $articles = Article::with('media')->latest()->take(6)->get();
        

        // Retourner la vue avec les articles
        return view('welcome', compact('articles'));
    }
}
