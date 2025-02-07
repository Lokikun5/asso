<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with('media')->where('active', true)->latest()->get();
        return view('articles.index', compact('articles'));
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

        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->text = $request->text;
        $article->type = $request->type;
        $article->slug = Str::slug($request->title);
        $article->active = true;

        if ($request->hasFile('img_banner')) {
            $imagePath = $request->file('img_banner')->store('articles', 'public');
            $article->img_banner = $imagePath;
        }

        $article->save();

        return redirect()->route('admin.articles.edit', $article->id)->with('success', 'Article ajouté avec succès.');
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
            'img_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->description = $request->description;
        $article->text = $request->text;
        $article->slug = Str::slug($request->title);

        // ✅ Gestion de l'image principale
        if ($request->hasFile('img_banner')) {
            if ($article->img_banner) {
                Storage::disk('public')->delete($article->img_banner);
            }
            $imagePath = $request->file('img_banner')->store('articles', 'public');
            $article->img_banner = $imagePath;
        }

        $article->save();

        // ✅ Gestion des nouvelles images de la galerie
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('articles/gallery', 'public');

                Media::create([
                    'file_name' => $path,
                    'article_id' => $article->id,
                ]);
            }
        }

        // ✅ Suppression des images sélectionnées
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $media = Media::find($imageId);
                if ($media) {
                    Storage::disk('public')->delete($media->file_name);
                    $media->delete();
                }
            }
        }

        return redirect()->route('admin.articles.edit', $article->id)->with('success', 'Article mis à jour avec succès.');
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

        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé avec succès.');
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