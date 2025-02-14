<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneriquePage;
use Illuminate\Http\Request;

class AdminGeneriquePageController extends Controller
{
    public function index()
    {
        $pages = GeneriquePage::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:generique_pages,slug',
            'content' => 'nullable|string',
        ]);

        GeneriquePage::create($request->all());

        return redirect()->route('admin.pages.index')->with('success', 'Page créée avec succès.');
    }

    public function edit(GeneriquePage $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, GeneriquePage $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:generique_pages,slug,' . $page->id,
            'content' => 'nullable|string',
        ]);

        $page->update($request->all());

        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour avec succès.');
    }

    public function destroy(GeneriquePage $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page supprimée avec succès.');
    }
}