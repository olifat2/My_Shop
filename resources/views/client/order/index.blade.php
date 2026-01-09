@extends('layouts.app')

@section('content')
<div>
    <div class="dashboard-header">
        <div>
            <h1>Commandes</h1>
            <p class="subtitle">Bienvenue ! Voici la liste de toutes vos commandes</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('client.profile.show') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-product">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Référence</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td data-label="N°">{{ $loop->iteration }}</td>
                    <td data-label="Référence">{{ $order->id }}</td>
                    <td data-label="Date">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td data-label="Statut">{{ $order->statut->nom }}</td>
                    <td data-label="Total">{{ number_format($order->total,0,',',' ') }} FCFA</td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                            <a href="{{ route('client.orders.show', $order->id) }}" class="btn-action btn-view" title="Voir">👁️</a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        Vous n'avez encore passé aucune commande.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection