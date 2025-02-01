<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;


class DashboardController extends Controller
{
    public function index()
    {
    
        // Récupérer tous les articles
        $articles = Article::latest()->paginate(10); // ✅ Paginer les résultats

        return view('admin.dashboard', compact('articles'));
    }
}
