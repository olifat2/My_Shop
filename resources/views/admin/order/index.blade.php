@extends('layouts.auth-admin.app')

@section('content')
<div class="container-dash-admin">
    <h1 class="text-2xl font-bold mb-4">Toutes les commandes</h1>

    @if($orders->isEmpty())
    <p>Aucune commande enregistrée.</p>
    @else
    <table class="table-product">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Référence</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->client->user->firstname }} {{ $order->client->user->lastname }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $order->statut->nom }}</td>
                <td>{{ number_format($order->total,0,',',' ') }} FCFA</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-product product-show">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection