@extends('layouts.auth-admin.app')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4">Commande #{{ $order->id }}</h1>

    <p><strong>Client :</strong> {{ $order->client->user->firstname }} {{ $order->client->user->lastname }}</p>
    <p><strong>Email :</strong> {{ $order->client->user->email }}</p>
    <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
        @csrf
        <label for="status">Modifier le statut :</label>
        <select name="status" id="status" class="status-select">
            @foreach($statuts as $statut)
            <option value="{{ $statut->id }}" {{ $order->statut_id === $statut->id ? 'selected' : '' }}>
                {{ $statut->nom }}
            </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-edit">Mettre à jour</button>
    </form>

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
@endsection
