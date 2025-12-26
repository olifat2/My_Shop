@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Détails de la commande #{{ $order->id }}</h1>

    <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut :</strong> {{ $order->statut->nom }}</p>
    <p><strong>Total :</strong> {{ number_format($order->total,0,',',' ') }} FCFA</p>

    <h2 class="text-xl font-semibold mt-4">Produits commandés</h2>
    <table class="table-product">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->categorie === 'produit_capillaire' ? $item->product->produitCapillaire->nom : $item->product->mecheExtension->style }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price,0,',',' ') }} FCFA</td>
                <td>{{ number_format($item->subtotal,0,',',' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
