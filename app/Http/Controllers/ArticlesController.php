<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    
    public function index()
    {
        $articles = Article::with('media')->latest()->paginate(6); 
        return view('articles.index', compact('articles'));
    }

    
    public function show($slug)
    {
        $article = Article::with('media')->where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'text' => 'required',
            'img_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->text = $request->text;
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('img_banner')) {
            $imagePath = $request->file('img_banner')->store('articles', 'public');
            $article->img_banner = $imagePath;
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article ajouté avec succès.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'text' => 'required',
            'img_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Recherche de l'article
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->text = $request->text;
        $article->slug = Str::slug($request->title);

        // Gestion de l'upload de la nouvelle image
        if ($request->hasFile('img_banner')) {
            // Supprime l'ancienne image
            if ($article->img_banner) {
                Storage::disk('public')->delete($article->img_banner);
            }
            $imagePath = $request->file('img_banner')->store('articles', 'public');
            $article->img_banner = $imagePath;
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès.');
    }

    // ✅ 7️⃣ Supprime un article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Supprime l'image associée si elle existe
        if ($article->img_banner) {
            Storage::disk('public')->delete($article->img_banner);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès.');
    }
}
