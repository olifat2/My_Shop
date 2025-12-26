@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Mes commandes</h1>

    @if($orders->isEmpty())
    <p>Vous n'avez encore passé aucune commande.</p>
    @else
    <table class="table-product">
        <thead>
            <tr>
                <th>#</th>
                <th>Référence</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Total (FCFA)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>{{ $order->statut->nom }}</td>
                <td>{{ number_format($order->total,0,',',' ') }}</td>
                <td>
                    <a href="{{ route('client.orders.show', $order->id) }}" class="btn-product product-show">Voir</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
