@extends('layouts.app')

@section('content')
<div>
    <h1>Détails de la commande #{{ $order->id }}</h1>

    <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Statut :</strong> {{ $order->statut->nom }}</p>

    <h2 class="text-xl font-semibold mt-4">Produits commandés</h2>
    <div class="table-responsive">
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
                @foreach($items as $item)
                <tr>
                    <td data-label="Nom"><span class="cell-brand">{{ $item->product->categorie === 'produit_capillaire' ? $item->product->produitCapillaire->nom : $item->product->mecheExtension->style }}</span></td>
                    <td data-label="Quantité">{{ $item->quantity }}</td>
                    <td data-label="Prix unitaire"><span class="cell-price">{{ number_format($item->price,0,',',' ') }} FCFA</span></td>
                    <td data-label="Total">{{ number_format($item->subtotal,0,',',' ') }} FCFA</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
