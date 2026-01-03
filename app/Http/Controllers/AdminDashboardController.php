<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $totalProducts = Product::count();
        $totalClients = User::where('role', 'client')->count();

        // Exemple si tu ajoutes plus tard une table commandes
        $totalOrders = Commande::count();
        $orders = Commande::get();
        $recentOrders = $orders->take(5);

        // Derniers produits ajoutés
        $latestProductsMeche = Product::where('categorie', 'meche_extension')->latest()->take(5)->get();
        $latestProductsCapillaire = Product::where('categorie', 'produit_capillaire')->latest()->take(5)->get();

        $lowItems = $lowStockProducts ?? collect();
        if (!isset($lowStockProducts)) {
            $lowItems = collect();
            if (isset($latestProductsMeche)) {
                foreach ($latestProductsMeche as $p) {
                    if ($p->stock->sum('quantite') <= 3) {
                        $lowItems->push($p);
                    }
                }
            }
            if (isset($latestProductsCapillaire)) {
                foreach ($latestProductsCapillaire as $p) {
                    if ($p->stock->sum('quantite') <= 3) {
                        $lowItems->push($p);
                    }
                }
            }
        }
        $items = $lowItems->take(6);

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
}
