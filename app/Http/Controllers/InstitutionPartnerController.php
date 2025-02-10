<?php

namespace App\Http\Controllers;
use App\Models\InstitutionPartner; 

use Illuminate\Http\Request;

class InstitutionPartnerController extends Controller
{
    
    public function index()
    {
        $institutionPartners = InstitutionPartner::where('active', true)->where('category', 'Écoles et universités')->get();

        $categorySubtitles = [
            'Écoles et universités' => "Co-organisation d'activités sur site",
            'Entreprises du secteur privé' => 'Accueil de stagiaires et sponsoring',
            'Services publics' => 'Soutien pour accéder à des subventions',
        ];

        return view('etablissements.index', compact('institutionPartners', 'categorySubtitles'));
    }
    

        public function adminIndex()
    {
        $institutionPartners = InstitutionPartner::orderBy('id', 'desc')->paginate(10);
        return view('admin.institution-partners.index', compact('institutionPartners'));
    }

    public function create()
    {
        return view('admin.institution-partners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'active' => 'required|boolean',
            'icon' => 'nullable|string',
        ]);

        InstitutionPartner::create($request->all());
        return redirect()->route('admin.institution-partners.index')->with('success', 'Établissement partenaire ajouté avec succès.');
    }

    public function edit($id)
    {
        $institutionPartner = InstitutionPartner::findOrFail($id);
        return view('admin.institution-partners.edit', compact('institutionPartner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'active' => 'required|boolean',
            'icon' => 'nullable|string',
        ]);

        $institutionPartner = InstitutionPartner::findOrFail($id);
        $institutionPartner->update($request->all());

        return redirect()->route('admin.institution-partners.index')->with('success', 'Établissement partenaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $institutionPartner = InstitutionPartner::findOrFail($id);
        $institutionPartner->delete();

        return redirect()->route('admin.institution-partners.index')->with('success', 'Établissement partenaire supprimé avec succès.');
    }

    public function toggleActive($id)
    {
        $institutionPartner = InstitutionPartner::findOrFail($id);
        $institutionPartner->active = !$institutionPartner->active;
        $institutionPartner->save();

        return redirect()->back()->with('success', 'Statut de l’établissement partenaire mis à jour.');
    }



}
