<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitutionPartner;

class SectorUtilitiesController extends Controller
{
    public function index()
    {
        // Récupérer les entreprises du Services publics
        $utilities = InstitutionPartner::where('active', true)->where('category', 'Services publics')->get();

        // Retourner la vue avec les données
        return view('services-publics.index', compact('utilities'));
    }
}
