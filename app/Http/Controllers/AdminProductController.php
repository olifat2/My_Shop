<?php

namespace App\Http\Controllers;

use App\Models\Effets;
use App\Models\Meche_Extension;
use App\Models\Nature_Actions;
use App\Models\Product;
use App\Models\Produit_Capillaire;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\Technique_Pose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminProductController extends Controller
{
    /**
     * Afficher la liste des produits.
     */
    public function index()
    {
        $products = Product::with(['mecheExtension', 'produitCapillaire', 'stock'])->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Afficher le formulaire d'ajout d'un produit
     */
    public function create()
    {
        $techniques = Technique_Pose::all();
        $effets = Effets::all();
        $natures = Nature_Actions::all();

        return view('admin.products.create', compact('techniques', 'effets', 'natures'));
    }

    /**
     * Enregistrer un nouveau produit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|in:meche_extension,produit_capillaire',
            'poids' => 'required|numeric|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $validated) {
            // Création du produit principal
            $product = Product::create([
                'categorie' => $validated['categorie'],
                'poids' => $validated['poids'],
                'prix_unitaire' => $validated['prix_unitaire'],
            ]);

            // Détails spécifiques
            if ($validated['categorie'] === 'meche_extension') {
                Meche_Extension::create([
                    'product_id' => $product->id,
                    'nature' => $request->nature,
                    'marque' => $request->marque,
                    'style' => $request->style,
                    'height' => $request->height,
                    'pcs' => $request->pcs,
                    'technique_pose_id' => $request->technique_pose_id,
                ]);
            } elseif ($validated['categorie'] === 'produit_capillaire') {
                Produit_Capillaire::create([
                    'product_id' => $product->id,
                    'nom' => $request->nom,
                    'volume' => $request->volume,
                    'effet_id' => $request->effet_id,
                    'nature_action_id' => $request->nature_action_id,
                ]);
            }

            // Création du stock initial
            Stock::create([
                'product_id' => $product->id,
                'quantite' => $validated['quantite'],
            ]);

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'type' => 'initial',
                'quantity_change' => $validated['quantite'],
                'before_quantity' => 0,
                'after_quantity' => $validated['quantite'],
                'note' => 'Stock initial à la création du produit',
            ]);
        });

        return redirect()->route('admin.products.create')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Afficher un produit
     */
    public function show(Product $product)
    {
        $product->load([
            'mecheExtension.techniquePose',
            'produitCapillaire.effet',
            'produitCapillaire.natureAction',
            'stock',
            'stockMovements.user',
        ]);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Afficher le formulaire d’édition
     */
    public function edit(Product $product)
    {
        $product->load(['mecheExtension', 'produitCapillaire']);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'poids' => 'required|numeric|min:0',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $validatedStock = $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $product->update($validated);

        if ($product->categorie === 'meche_extension') {
            $product->mecheExtension->update($request->only(['nature', 'marque', 'style', 'pcs', 'height', 'technique_pose_id']));
        } elseif ($product->categorie === 'produit_capillaire') {
            $product->produitCapillaire->update($request->only(['nom', 'effet_id', 'nature_action_id', 'volume']));
        }

        $stock = $product->stock()->first();
        $beforeQuantity = $stock?->quantite ?? 0;
        $afterQuantity = $validatedStock['quantite'];

        $product->stock()->updateOrCreate(
            ['product_id' => $product->id],
            $validatedStock
        );

        if ($beforeQuantity !== $afterQuantity) {
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'type' => 'adjustment',
                'quantity_change' => $afterQuantity - $beforeQuantity,
                'before_quantity' => $beforeQuantity,
                'after_quantity' => $afterQuantity,
                'note' => 'Ajustement manuel du stock',
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit
     */
    public function destroy(Product $product)
    {
        if ($product->categorie === 'meche_extension' && $product->mecheExtension) {
            $product->mecheExtension->delete();
        }

        if ($product->categorie === 'produit_capillaire' && $product->produitCapillaire) {
            $product->produitCapillaire->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
