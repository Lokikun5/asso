<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    /**
     * Affiche tous les podcasts actifs (frontend)
     */
    public function index(Request $request)
    {
        $query = Podcast::where('active', true)->latest();

        // Filtrer par catégorie si sélectionnée
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $podcasts = $query->paginate(10);

        // Récupérer les catégories uniques (sans doublons)
        $categories = Podcast::where('active', true)->pluck('category')->unique();

        return view('podcasts.index', compact('podcasts', 'categories'));
    }


    /**
     * Affiche un podcast spécifique
     */
    public function show($slug)
    {
        $podcast = Podcast::where('slug', $slug)->firstOrFail();
        return view('podcasts.show', compact('podcast'));
    }

    // ✅ GESTION ADMIN (Back-office)

    /**
     * Affiche la liste des podcasts dans le back-office
     */
    public function adminIndex()
    {
        $podcasts = Podcast::latest()->paginate(10);
        return view('admin.podcasts.index', compact('podcasts'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.podcasts.create');
    }

    /**
     * Enregistre un podcast en base de données
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'page_content' => 'required',
            'file' => 'required|mimes:mp3,wav,ogg|max:204800',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2 MB max
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $podcast = new Podcast();
        $podcast->name = $request->name;
        $podcast->description = $request->description;
        $podcast->category = $request->category;
        $podcast->page_content = $request->page_content;
        $podcast->active = $request->has('active');
        $podcast->slug = Str::slug($request->name);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('podcasts', 'public');
            $podcast->file = $filePath;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('podcasts/images', 'public');
            $podcast->image = $imagePath;
        }

        $podcast->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('podcasts/gallery', 'public');

                Media::create([
                    'file_name' => $path,
                    'podcast_id' => $podcast->id,
                ]);
            }
        }

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification
     */
    public function edit($id)
    {
        $podcast = Podcast::with('media')->findOrFail($id);
        return view('admin.podcasts.edit', compact('podcast'));
    }

    /**
     * Met à jour un podcast
     */
    public function update(Request $request, $id)
    {
        $podcast = Podcast::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'page_content' => 'required',
            'file' => 'nullable|mimes:mp3,wav,ogg|max:204800', // 10 MB max
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2 MB max
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096'
        ]);

        $podcast->name = $request->name;
        $podcast->description = $request->description;
        $podcast->category = $request->category;
        $podcast->page_content = $request->page_content;
        $podcast->active = $request->has('active');

        if ($request->hasFile('file')) {
            if ($podcast->file) {
                Storage::disk('public')->delete($podcast->file);
            }
            $filePath = $request->file('file')->store('podcasts', 'public');
            $podcast->file = $filePath;
        }

        if ($request->hasFile('image')) {
            if ($podcast->image) {
                Storage::disk('public')->delete($podcast->image);
            }
            $imagePath = $request->file('image')->store('podcasts/images', 'public');
            $podcast->image = $imagePath;
        }

        $podcast->save();

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('podcasts/gallery', 'public');

                Media::create([
                    'file_name' => $path,
                    'podcast_id' => $podcast->id,
                ]);
            }
        }

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $media = Media::find($imageId);
                if ($media) {
                    Storage::disk('public')->delete($media->file_name);
                    $media->delete();
                }
            }
        }


        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast mis à jour avec succès.');
    }

    /**
     * Supprime un podcast
     */
    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);

        if ($podcast->file) {
            Storage::disk('public')->delete($podcast->file);
        }

        if ($podcast->image) {
            Storage::disk('public')->delete($podcast->image);
        }

        foreach ($podcast->media as $media) {
            Storage::disk('public')->delete($media->file_name);
            $media->delete();
        }

        $podcast->delete();

        return redirect()->route('admin.podcasts.index')->with('success', 'Podcast supprimé avec succès.');
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


    /**
     * Activer/Désactiver un podcast (Back-office)
     */
    public function toggleActive($id)
    {
        $podcast = Podcast::findOrFail($id);
        $podcast->active = !$podcast->active; // Inverse le statut
        $podcast->save();

        return redirect()->back()->with('success', 'Statut du podcast mis à jour.');
    }
}