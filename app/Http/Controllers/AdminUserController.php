<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // ✅ Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::where('role', 'admin')->get(); // Filtrer les administrateurs
        return view('admin.users.index', compact('users'));
    }

    // ✅ Afficher le formulaire pour créer un utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // ✅ Enregistrer un nouvel utilisateur (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin' // Définir le rôle en tant qu'admin
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès !');
    }

    // ✅ Afficher le formulaire d'édition d'un utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user(); // Récupère l'utilisateur actuellement connecté
        return view('admin.users.profile', compact('user'));
    }

    // ✅ Mettre à jour un utilisateur existant
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // ✅ Supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}