<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminClientController extends Controller
{
    /**
     * Afficher tous les clients
     */
    public function index()
    {
        // Récupère uniquement les utilisateurs de rôle 'client'
        $clients = User::where('role', 'client')->paginate(15); // pagination si nécessaire

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Afficher le détail d’un client
     */
    public function show($id)
    {
        $client = User::where('role', 'client')->with('commandes')->findOrFail($id);

        return view('admin.clients.show', compact('client'));
    }

    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Enregistrer un nouveau client
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'client',
        ]);

        Client::create(['user_id' => $user->id]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client créé avec succès.');
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);

        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Mettre à jour un client
     */
    public function update(Request $request, $id)
    {
        $client = User::where('role', 'client')->findOrFail($id);

        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$client->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // ne pas modifier si vide
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Supprimer un client
     */
    public function destroy($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
