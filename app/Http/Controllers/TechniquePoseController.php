<?php

namespace App\Http\Controllers;

use App\Models\Technique_Pose;
use Illuminate\Http\Request;

class TechniquePoseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:100|unique:technique_poses,nom',
        ]);

        Technique_Pose::create([
            'nom' => $request->nom,
        ]);

        return redirect()
            ->route('admin.products.create')
            ->with('success', "Vous venez d'ajouter une nouvelle technique de pose pour vos mèches.");
    }
}
