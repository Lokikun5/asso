<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        // Récupère tous les types d'articles uniques
        $types = Article::where('active', true)->pluck('type')->unique();

        // Vérifie si un filtre est appliqué
        $selectedType = $request->query('type');

        // Filtre les articles en fonction du type sélectionné
        $articles = Article::with('media')
                    ->where('active', true)
                    ->when($selectedType, function ($query) use ($selectedType) {
                        return $query->where('type', $selectedType);
                    })
                    ->latest()
                    ->get();

        return view('articles.index', compact('articles', 'types', 'selectedType'));
    }


    public function show($slug)
    {
        $article = Article::with('media')->where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'text' => 'required',
        'type' => 'required|string',
        'img_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $slug = Str::slug($request->title);
    $originalSlug = $slug;
    $counter = 1;

    // Vérifier si le slug existe déjà, si oui, ajouter un suffixe numérique
    while (Article::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    $article = new Article();
    $article->title = $request->title;
    $article->description = $request->description;
    $article->text = $request->text;
    $article->type = $request->type;
    $article->slug = $slug; // ✅ Slug unique
    $article->active = true;

    if ($request->hasFile('img_banner')) {
        $imagePath = $request->file('img_banner')->store('articles', 'public');
        $article->img_banner = $imagePath;
    }

    $article->save();

    return redirect()->route('admin.dashboard')->with('success', 'Article ajouté avec succès.');
    }


    public function edit($id)
    {
        $article = Article::with('media')->findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'text' => 'required',
            'type' => 'required|string',
            'img_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->text = $request->text;
        $article->type = $request->type;

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;

        // Vérifier si le slug existe déjà pour un autre article
        while (Article::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $article->slug = $slug; // ✅ Slug unique

        if ($request->hasFile('img_banner')) {
            if ($article->img_banner) {
                Storage::disk('public')->delete($article->img_banner);
            }
            $imagePath = $request->file('img_banner')->store('articles', 'public');
            $article->img_banner = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.dashboard')->with('success', 'Article mis à jour avec succès.');
    }


    public function toggle($id)
    {
        $article = Article::findOrFail($id);
        $article->active = !$article->active;
        $article->save();

        return redirect()->back()->with('success', 'Statut de l\'article mis à jour.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->img_banner) {
            Storage::disk('public')->delete($article->img_banner);
        }

        foreach ($article->media as $media) {
            Storage::disk('public')->delete($media->file_name);
            $media->delete();
        }

        $article->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Article supprimé avec succès.');
    }

    // ✅ 📌 Méthode pour uploader une image dans la galerie
    public function storeMedia(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'Aucun fichier envoyé.'], 400);
        }

        if (!$request->has('article_id') || !Article::find($request->article_id)) {
            return response()->json(['error' => 'Article non trouvé.'], 400);
        }

        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        $path = $request->file('file')->store('articles/gallery', 'public');

        $media = new Media();
        $media->name = $file->getClientOriginalName();
        $media->file_name = $path;
        $media->article_id = $request->article_id;
        $media->save();

        return response()->json([
            'location' => asset('storage/' . $path),
            'media_id' => $media->id
        ]);
    }

    public function deleteMedia($id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json(['error' => 'Média non trouvé.'], 404);
        }

        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        $media->delete();

        return response()->json(['success' => true]);
    }
}