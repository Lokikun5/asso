<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneriquePage;
use Illuminate\View\View;

class GeneriquePageController extends Controller
{
    public function show(GeneriquePage $page): View
    {
        return view('pages.show', compact('page'));
    }

    
}
