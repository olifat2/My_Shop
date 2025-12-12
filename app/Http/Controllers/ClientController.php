<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Page d’accueil client (6 derniers produits)
    public function home()
    {
        $products = Product::latest()->take(6)->get();
        return view('client.home', compact('products'));
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

    // Dashboard client
    public function dashboard()
    {
        $user = Auth::user();
        return view('client.dashboard', compact('user'));
    }

    // Panier du client
    public function cart()
    {
        // À court terme -> panier en session
        $cart = session()->get('cart', []);
        return view('client.cart', compact('cart'));
    }

    // Ajouter au panier
    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $cart[$productId] = [
                'name' => $product->categorie,
                'price' => $product->prix_unitaire,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Retirer du panier
    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    // Historique des commandes
    public function orders()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();

        return view('client.orders.index', compact('orders'));
    }

    // Détails d’une commande
    public function orderDetails($orderId)
    {
        $user = Auth::user();
        $order = $user->orders()->where('id', $orderId)->firstOrFail();

        return view('client.orders.show', compact('order'));
    }
}
