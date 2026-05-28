@extends('layouts.auth-admin.app')

@section('content')
<div>
    <div class="dashboard-header">
        <div>
            <h1>Détails de la commande #{{ $order->id }}</h1>
            <p class="subtitle">Informations sur votre commande et les produits associés.</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    <!-- Informations de la commande -->
    <div class="section-card">
        <h2>Résumé de la commande</h2>

        <div class="order-info-grid">
            <div class="order-info-item">
                <strong>Client</strong>
                <p>{{ $order->client->user->firstname }} {{ $order->client->user->lastname }}</p>
            </div>

            <div class="order-info-item">
                <strong>Date</strong>
                <p>{{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="order-info-item">
                <strong>Statut</strong>
                <p>{{ ucfirst($order->statut->nom) }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="status-form">
            @csrf
            <select name="status" class="status-select">
                @foreach($statuts as $statut)
                <option value="{{ $statut->id }}" @selected($order->statut_id === $statut->id)>
                    {{ $statut->nom }}
                </option>
                @endforeach
            </select>
            <button class="btn btn-edit">Mettre à jour</button>
        </form>
    </div>

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
                    @foreach($order->items as $item)
                    <tr>
                        <td data-label="Nom">
                            <span class="cell-brand">
                                {{ $item->product->categorie === 'produit_capillaire' ? $item->product->produitCapillaire->nom : $item->product->mecheExtension->style }}
                            </span>
                        </td>
                        <td data-label="Quantité">{{ $item->quantity }}</td>
                        <td data-label="Prix unitaire">
                            <span class="cell-price">
                                {{ number_format($item->price,0,',',' ') }} FCFA
                            </span>
                        </td>
                        <td data-label="Total">{{ number_format($item->subtotal,0,',',' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection