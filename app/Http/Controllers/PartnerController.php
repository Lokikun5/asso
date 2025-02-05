<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Afficher la liste des partenaires.
     */
    public function index()
    {
        $partners = Partner::orderBy('last_name')->get();
        return view('partenaires.index', compact('partners'));
    }


    /**
     * Afficher un partenaire spécifique.
     */
    public function show($slug)
    {
        $partner = Partner::where('slug', $slug)->firstOrFail();
        return view('partenaires.show', compact('partner'));
    }
}
