<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitutionPartner;

class PrivateSectorCompanyController extends Controller
{
    public function index()
    {
        // Récupérer les entreprises du secteur privé
        $companies = InstitutionPartner::where('active', true)->where('category', 'Entreprises du secteur privé')->get();

        // Retourner la vue avec les données
        return view('entreprises-du-secteur-privé.index', compact('companies'));
    }
}