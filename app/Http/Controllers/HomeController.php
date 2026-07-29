<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function showAccueilScreen()
    {
        $latestProducts = Product::with(['mecheExtension', 'produitCapillaire', 'stock'])->latest()->get();
        $highItems = $latestProducts->filter(fn ($product) => $product->stock->sum('quantite') >= 10);

        return view('home', compact('highItems'));
    }

    // Catalogue complet
    public function listProducts()
    {
        $products = Product::with(['mecheExtension', 'produitCapillaire', 'stock'])->get();

        return view('client.products.index', compact('products'));
    }

    // Détails d’un produit
    public function showProduct(Product $product)
    {
        $product->load(['mecheExtension', 'produitCapillaire', 'stock']);

        return view('client.products.show', compact('product'));
    }
}
