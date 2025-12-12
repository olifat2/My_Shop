<?php

namespace App\Http\Controllers;

use App\Models\Nature_Actions;
use Illuminate\Http\Request;

class NatureActionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100|unique:nature_actions,nom',
        ]);

        Nature_Actions::create([
            'nom' => $request->nom,
        ]);
        return redirect()
            ->route('admin.products.create')->with('success', "Vous venez d'ajouter une nouvelle nature d'action pour vos produits capillaires.");
    }
}
