@extends('layouts.app')

@section('content')
<div class="cart-container">

    <h1>Mon panier</h1>

    @php
    $cart = session('cart', []);
    $total = collect($cart)->sum('subtotal');
    @endphp

    @if(empty($cart))
    <p>Votre panier est vide.</p>
    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
    @else
    <table class="cart-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ number_format($item['price'], 0, ',', ' ') }} FCFA</td>

                <td>
                    <form class="update-cart-form" action="{{ route('client.cart.update', $item['id']) }}" method="POST">
                        @csrf
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1">
                        <button type="submit">OK</button>
                    </form>
                </td>

                <td>{{ number_format($item['subtotal'], 0, ',', ' ') }} FCFA</td>

                <td>
                    <form action="{{ route('client.cart.remove', $item['id']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">✕</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-summary">
        <strong>Total :</strong>
        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
    </div>

    <div class="cart-actions">
        <a href="{{ route('client.index') }}" class="btn btn-secondary">Continuer vos achats</a>
        <a href="#" class="btn btn-primary">Passer la commande →</a>
    </div>
    @endif

</div>
@endsection