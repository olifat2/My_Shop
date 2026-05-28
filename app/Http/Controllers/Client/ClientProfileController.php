<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClientProfileController extends Controller
{
    /**
     * Afficher le profil du client connecté
     */
    public function show()
    {
        $user = Auth::user();

        return view('client.profile.show', compact('user'));
    }

    /**
     * Afficher le formulaire d’édition du profil
     */
    public function edit()
    {
        $user = Auth::user();

        return view('client.profile.edit', compact('user'));
    }

    /**
     * Mettre à jour les informations du profil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:100'],
            'lastname'  => ['required', 'string', 'max:100'],
            'email'     => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($validated);

        return redirect()
            ->route('client.profile.show')
            ->with('success', 'Profil mis à jour avec succès.');
    }
}
