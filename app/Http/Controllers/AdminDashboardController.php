<?php

namespace App\Http\Controllers;

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
        $totalAdmins = User::where('role', 'admin')->count();

        // Exemple si tu ajoutes plus tard une table commandes
        // $totalOrders = Order::count();
        $totalOrders = 0;

        // Derniers produits ajoutés
        $latestProductsMeche = Product::where('categorie', 'meche_extension')->latest()->take(5)->get();
        $latestProductsCapillaire = Product::where('categorie', 'produit_capillaire')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalClients',
            'totalAdmins',
            'totalOrders',
            'latestProductsMeche',
            'latestProductsCapillaire'
        ));
    }
}
