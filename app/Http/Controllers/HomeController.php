<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function showAccueilScreen()
    {
        $latestProducts = Product::with(['mecheExtension', 'produitCapillaire'])->get();
        
        // Filtrer les produits avec stock >= 10 pour les mettre en vedette
        $highItems = collect($latestProducts)->filter(fn($p) => $p->stock->sum('quantite') >= 10);

        return view('home', compact(
            'highItems'
        ));
    }

    // Catalogue complet
    public function listProducts()
    {
        $products = Product::with(['mecheExtension', 'produitCapillaire'])->get();
        return view('client.products.index', compact('products'));
    }

    // Détails d’un produit
    public function showProduct(Product $product)
    {
        $product->load(['mecheExtension', 'produitCapillaire']);
        return view('client.products.show', compact('product'));
    }
}
