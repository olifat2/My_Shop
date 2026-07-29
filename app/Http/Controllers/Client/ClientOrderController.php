<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Product;
use App\Models\StatutCommande;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    // =========================
    // Liste des commandes du client
    // =========================
    public function index()
    {
        $user = Auth::user();
        $client = $user->client()->firstOrCreate([]);

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
        $client = $user->client()->firstOrCreate([]);

        $order = $client->commandes()
            ->where('id', $orderId)
            ->with([
                'items.product.mecheExtension',
                'items.product.produitCapillaire',
                'statut',
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
        $client = $user->client()->firstOrCreate([]);
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            $productIds = collect($cart)->pluck('id')->all();
            $products = Product::with('stock')->whereIn('id', $productIds)->get()->keyBy('id');
            $statut = StatutCommande::where('nom', 'en_attente')->firstOrFail();
            $total = 0;

            $commande = Commande::create([
                'client_id' => $client->id,
                'statut_id' => $statut->id,
                'reference' => 'CMD-'.strtoupper(uniqid()),
                'total' => 0,
            ]);

            foreach ($cart as $item) {
                $product = $products->get($item['id']);

                if (! $product) {
                    throw new \RuntimeException('Produit introuvable.');
                }

                $quantity = max(1, (int) $item['qty']);
                $stock = $product->stock()->lockForUpdate()->first();

                if (! $stock || $stock->quantite < $quantity) {
                    throw new \RuntimeException('Stock insuffisant pour un ou plusieurs produits.');
                }

                $price = $product->prix_unitaire;
                $subtotal = $quantity * $price;
                $total += $subtotal;

                CommandeItem::create([
                    'commande_id' => $commande->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $beforeQuantity = $stock->quantite;
                $stock->decrement('quantite', $quantity);
                $afterQuantity = $beforeQuantity - $quantity;

                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'commande_id' => $commande->id,
                    'type' => 'sale',
                    'quantity_change' => -$quantity,
                    'before_quantity' => $beforeQuantity,
                    'after_quantity' => $afterQuantity,
                    'note' => 'Sortie de stock liée à une commande client',
                ]);
            }

            $commande->update(['total' => $total]);

            // Vider le panier
            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('client.orders.show', $commande->id)
                ->with('success', 'Commande créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage() ?: 'Erreur lors de la création de la commande.');
        }
    }

    // =========================
    // Page de confirmation (optionnelle mais recommandée)
    // =========================
    public function confirmation($orderId)
    {
        $user = Auth::user();
        $client = $user->client()->firstOrCreate([]);

        $order = $client->commandes()
            ->with('statut')
            ->findOrFail($orderId);

        return view('client.order.confirmation', compact('order'));
    }
}
