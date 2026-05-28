<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\LigneCommande;
use App\Models\StatutCommande;

class ClientOrderController extends Controller
{
    // =========================
    // Liste des commandes du client
    // =========================
    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        $orders = $client->commandes()
            ->with('statut')
            ->latest()
            ->get();

        return view('client.order.index', compact('orders'));
    }

    // =========================
    // Détails d’une commande
    // =========================
    public function show($orderId)
    {
        $user = Auth::user();
        $client = $user->client;

        $order = $client->commandes()
            ->where('id', $orderId)
            ->with([
                'items.product.mecheExtension',
                'items.product.produitCapillaire',
                'statut'
            ])
            ->firstOrFail();

        $items = $order->items;

        return view('client.order.show', compact('order', 'items'));
    }

    // =========================
    // Création de la commande depuis le panier
    // =========================
    public function store(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            $total = collect($cart)->sum('subtotal');

            $statut = StatutCommande::where('nom', 'en_attente')->firstOrFail();

            $commande = Commande::create([
                'client_id' => $client->id,
                'statut_id' => $statut->id,
                'total' => $total,
                'reference' => 'CMD-' . strtoupper(uniqid()),
            ]);

            foreach ($cart as $item) {
                CommandeItem::create([
                    'commande_id' => $commande->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            // Vider le panier
            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('client.orders.show', $commande->id)
                ->with('success', 'Commande créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Erreur lors de la création de la commande.');
        }
    }

    // =========================
    // Page de confirmation (optionnelle mais recommandée)
    // =========================
    public function confirmation($orderId)
    {
        $user = Auth::user();
        $client = $user->client;

        $order = $client->commandes()
            ->with('statutCommande')
            ->findOrFail($orderId);

        return view('client.order.confirmation', compact('order'));
    }
}
