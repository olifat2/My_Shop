@extends('layouts.app')

@section('content')
<div>
    <div class="dashboard-header">
        <div>
            <h1>Détails de la commande #{{ $order->id }}</h1>
            <p class="subtitle">Informations sur votre commande et les produits associés.</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('client.orders.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    <!-- Informations de la commande -->
    <div>
        <h2>Résumé de la commande</h2>
        <div>
            <div>
                <p>Date de la commande</p>
                <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p>Statut</p>
                <p>{{ $order->statut->nom }}</p>
            </div>
        </div>
    </div>

    <!-- Produits commandés -->
    <div>
        <h2>Produits commandés</h2>

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
</div>
@endsection