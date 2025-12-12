<?php

namespace App\Http\Controllers;

use App\Models\Effets;
use Illuminate\Http\Request;

class EffetController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100|unique:effets,nom',
        ]);

        Effets::create([
            'nom' => $request->nom,
        ]);

        return redirect()
            ->route('admin.products.create')->with('success', "Vous venez d'ajouter un nouvel effet pour vos produits capillaires.");
    }
}
