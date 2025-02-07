<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Afficher la liste des partenaires actifs (Front)
     */
    public function index()
    {
        $partners = Partner::where('active', true)->orderBy('last_name')->get();
        return view('partenaires.index', compact('partners'));
    }

    /**
     * Afficher la liste des partenaires (Back-office)
     */
    public function adminIndex()
    {
        $partners = Partner::orderBy('id', 'desc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    /**
     * Afficher un partenaire spécifique (Front)
     */
    public function show($slug)
    {
        $partner = Partner::where('slug', $slug)->firstOrFail();
        return view('partenaires.show', compact('partner'));
    }

    /**
     * Afficher le formulaire de création d’un partenaire (Back-office)
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Enregistrer un nouveau partenaire (Back-office)
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'required|string',
            'text' => 'required|string',
            'partner_link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $partner = new Partner();
        $partner->first_name = $request->first_name;
        $partner->last_name = $request->last_name;
        $partner->description = $request->description;
        $partner->text = $request->text;
        $partner->partner_link = $request->partner_link;
        $partner->slug = Str::slug($request->first_name . ' ' . $request->last_name, '-');
        $partner->active = true; // Par défaut, le partenaire est actif

        // ✅ Gestion de l’image de profil
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('partners', 'public');
            $partner->profile_picture = $imagePath;
        }

        $partner->save();
        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire ajouté avec succès.');
    }

    /**
     * Afficher le formulaire d’édition d’un partenaire (Back-office)
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Mettre à jour un partenaire (Back-office)
     */
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'required|string',
            'text' => 'required|string',
            'partner_link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $partner->first_name = $request->first_name;
        $partner->last_name = $request->last_name;
        $partner->description = $request->description;
        $partner->text = $request->text;
        $partner->partner_link = $request->partner_link;
        $partner->slug = Str::slug($request->first_name . ' ' . $request->last_name, '-');

        // ✅ Gestion de la mise à jour de l’image de profil
        if ($request->hasFile('profile_picture')) {
            if ($partner->profile_picture) {
                Storage::disk('public')->delete($partner->profile_picture);
            }
            $imagePath = $request->file('profile_picture')->store('partners', 'public');
            $partner->profile_picture = $imagePath;
        }

        $partner->save();
        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire mis à jour avec succès.');
    }

    /**
     * Supprimer un partenaire (Back-office)
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // ✅ Suppression de l’image associée si elle existe
        if ($partner->profile_picture) {
            Storage::disk('public')->delete($partner->profile_picture);
        }

        $partner->delete();
        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire supprimé avec succès.');
    }

    /**
     * Activer/Désactiver un partenaire (Back-office)
     */
    public function toggleActive($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->active = !$partner->active; // Inverse le statut
        $partner->save();

        return redirect()->back()->with('success', 'Statut du partenaire mis à jour.');
    }
}