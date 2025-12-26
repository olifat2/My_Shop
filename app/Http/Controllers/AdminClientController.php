<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
        $client = User::where('role', 'client')->with('client')->findOrFail($id);

        return view('admin.clients.show', compact('client'));
    }

    /**
     * Supprimer un client
     */
    public function destroy($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client supprimé avec succès.');
    }
}
