<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{

    public function submit(Request $request)
    {
        // Validation des données avec regex
        $validated = $request->validate([
            'nom' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\s-]+$/'],
            'prenom' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\s-]+$/'],
            'email' => ['required', 'email'],
            'telephone' => ['nullable', 'regex:/^\+?[0-9]{10,15}$/'],
            'message' => ['required', 'string', 'min:10', 'max:1000']
        ]);

        // Envoi de l'email
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactMail($validated));

        return response()->json([
            'message' => 'Merci ' . $validated['prenom'] . '! Votre message a bien été envoyé. Nous vous répondrons sous peu.'
        ], 200);
    }
}
