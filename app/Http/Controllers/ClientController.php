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
        $products = Product::with(['mecheExtension', 'produitCapillaire'])->get();

        // Filtrer les produits avec stock >= 10 pour les mettre en vedette
        $highItems = collect($products)->filter(fn($p) => $p->stock->sum('quantite') >= 10);
        $items = $highItems->take(4);

        return view('client.homeClient', compact('items'));
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
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum('subtotal');

        return view('client.cart', compact('cart', 'total'));
    }

    // Ajouter au panier
    public function addToCart($productId)
    {
        $product = Product::with(['mecheExtension', 'produitCapillaire'])->findOrFail($productId);

        $name = $product->categorie === 'produit_capillaire'
            ? $product->produitCapillaire->nom
            : $product->mecheExtension->style;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $name,
                'price' => $product->prix_unitaire,
                'qty' => 1,
                'subtotal' => $product->prix_unitaire,
            ];
        }

        // Recalcul du sous-total
        $cart[$productId]['subtotal'] = $cart[$productId]['qty'] * $cart[$productId]['price'];

        session()->put('cart', $cart);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'count' => collect(session('cart', []))->sum('qty'),
                'total' => array_sum(array_map(fn($item) => $item['subtotal'], session('cart', []))),
                'items' => session('cart', [])
            ]);
        }

        return redirect()->back();
    }

    // Augmenter / diminuer la quantité dans le panier
    public function updateCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $qty = max(1, (int) $request->qty);
            $cart[$productId]['qty'] = $qty;
            $cart[$productId]['subtotal'] = $qty * $cart[$productId]['price'];
            session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'itemSubtotal' => $cart[$productId]['subtotal'] ?? 0,
                'total' => collect($cart)->sum('subtotal'),
                'count' => collect($cart)->sum('qty')
            ]);
        }

        return redirect()->back();
    }

    // Retirer du panier
    public function removeFromCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'total' => collect($cart)->sum('subtotal'),
                'count' => collect($cart)->sum('qty'),
                'items' => $cart // Pour mini-cart dynamique
            ]);
        }

        return redirect()->back();
    }
}
