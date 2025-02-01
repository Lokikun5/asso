<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Afficher la page de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gérer la soumission du formulaire de connexion
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Vérifier les identifiants
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Rediriger vers le back-office si l'utilisateur est admin
            return redirect()->route('dashboard')->with('success', 'Connexion réussie !');
        }

        // En cas d'échec
        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Déconnexion réussie !');
    }
}
