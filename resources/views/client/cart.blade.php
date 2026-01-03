@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Mon panier</h1>

    @php
    $cart = session('cart', []);
    $total = collect($cart)->sum('subtotal');
    @endphp

    @if(empty($cart))
    <p>Votre panier est vide.</p>
    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
    @else
    <div class="table-responsive">
        <table class="table-product">
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
                    <td data-label="Nom"><span class="cell-brand">{{ $item['name'] }}</span></td>
                    <td data-label="Prix"><span class="cell-price">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</span></td>
                    <td data-label="Quantité">
                        <form class="update-cart-form" action="{{ route('client.cart.update', $item['id']) }}" method="POST">
                            @csrf
                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1">
                            <button type="submit" title="Modifier" class="btn-action btn-edit">OK</button>
                        </form>
                    </td>

                    <td data-label="Total">{{ number_format($item['subtotal'], 0, ',', ' ') }} FCFA</td>

                    <td data-label="Actions">
                        <div class="actions-buttons">
                            <form action="{{ route('client.cart.remove', $item['id']) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Supprimer">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="cart-summary">
        <strong>Total :</strong>
        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
    </div>

    <div class="cart-actions">
        <a href="{{ route('client.index') }}" class="btn btn-secondary">Continuer vos achats</a>
        <form action="{{ route('client.orders.store') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">Passer la commande →</button>
        </form>
    </div>
    @endif

</div>
@endsection
