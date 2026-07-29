<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalClients = User::where('role', 'client')->count();
        $totalOrders = Commande::count();

        $orders = Commande::all();
        $recentOrders = $orders->take(5);

        $latestProductsMeche = $this->latestProductsByCategory('meche_extension');
        $latestProductsCapillaire = $this->latestProductsByCategory('produit_capillaire');

        $items = $this->lowStockProducts(
            $latestProductsMeche,
            $latestProductsCapillaire
        )->take(6);

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalClients',
            'totalOrders',
            'orders',
            'recentOrders',
            'latestProductsMeche',
            'latestProductsCapillaire',
            'items'
        ));
    }

    /**
     * Récupère les derniers produits par catégorie
     */
    private function latestProductsByCategory(string $category)
    {
        return Product::where('categorie', $category)
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Retourne les produits avec stock faible
     */
    private function lowStockProducts(...$collections)
    {
        return collect($collections)
            ->flatten()
            ->filter(fn ($product) => $product->stock->sum('quantite') <= 3)
            ->values();
    }
}
