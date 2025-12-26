<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ClientOrderController extends Controller
{
    // Liste des commandes du client
    public function index()
    {
        $user = Auth::user();
        $client = $user->client; // relation User -> Client

        $orders = $client->orders()->latest()->get();

        return view('client.order.index', compact('orders'));
    }

    // Détails d’une commande
    public function show($orderId)
    {
        $user = Auth::user();
        $client = $user->client;

        $order = $client->orders()->where('id', $orderId)->with('items.product.mecheExtension', 'items.product.produitCapillaire', 'statut')->firstOrFail();

        return view('client.order.show', compact('order'));
    }
}
