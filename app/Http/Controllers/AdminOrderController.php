<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\StatutCommande;

class AdminOrderController extends Controller
{
    // Liste de toutes les commandes
    public function index()
    {
        $orders = Commande::with('client.user', 'statut')->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    // Détails d’une commande
    public function show($orderId)
    {
        $order = Commande::with('client.user', 'items.product.mecheExtension', 'items.product.produitCapillaire', 'statut')->findOrFail($orderId);
        $statuts = StatutCommande::all();

        return view('admin.orders.show', compact('order', 'statuts'));
    }

    // Mise à jour du statut
    public function updateStatus(Request $request, $orderId)
    {
        $order = Commande::findOrFail($orderId);

        $request->validate([
            'status' => 'required|exists:statut_commandes,id',
        ]);

        $order->statut_id = $request->status;
        $order->save();

        // Redirection ou réponse AJAX possible
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
}
