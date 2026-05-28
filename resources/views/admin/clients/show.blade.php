@extends('layouts.auth-admin.app')

@section('content')
<div class="admin-container">

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Détails du client</h1>
            <p class="subtitle">Informations complètes sur le client</p>
        </div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                Retour
            </a>
        </div>
    </div>

    <!-- Informations client -->
    <div class="section-card">
        <h2>Informations personnelles</h2>

        <div class="client-info-grid">
            <div class="client-info-item">
                <span>Nom</span>
                <p>{{ $client->firstname }}</p>
            </div>
            <div class="client-info-item">
                <span>Prénom</span>
                <p>{{ $client->lastname }}</p>
            </div>
            <div class="client-info-item">
                <span>Email</span>
                <p>{{ $client->email }}</p>
            </div>
            <div class="client-info-item">
                <span>Date d’inscription</span>
                <p>{{ $client->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Historique commandes -->
    @if($client->commandes->count() > 0)
    <div>
        <h2>Historique des commandes</h2>

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
                    @foreach($client->commandes as $order)
                    <tr>
                        <td data-label="N°">{{ $loop->iteration }}</td>
                        <td data-label="Référence">{{ $order->id }}</td>
                        <td data-label="Date">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td data-label="Statut">
                            <span class="status-badge">
                                {{ $order->statut->nom }}
                            </span>
                        </td>
                        <td data-label="Total">{{ number_format($order->total,0,',',' ') }} FCFA</td>
                        <td data-label="Actions">
                            <div class="actions-buttons">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action btn-view">
                                    👁️
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>
@endsection