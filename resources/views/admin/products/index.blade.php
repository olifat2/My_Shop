@extends('layouts.auth-admin.app')

@section('content')
<div class="admin-container">
    <div class="header-actions actions-index">
        <h1>Produits</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-product product-add">Nouveau produit</a>
    </div>

    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="table-container">
        <table class="table-product">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identification</th>
                    <th>Prix (FCFA)</th>
                    <th>Stock</th>
                    <th>Détails</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->categorie === 'produit_capillaire' ? $product->produitCapillaire->nom : $product->mecheExtension->style }}</td>
                    <td>{{ number_format($product->prix_unitaire, 0, ',', ' ') }}</td>
                    <td>{{ $product->stock->sum('quantite') }}</td>
                    <td class="details-product">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-product product-show">Voir la fiche</a>
                    </td>
                    <td class="actions-product">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-product product-edit">Modifier ses informations</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Supprimer ce produit ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-product product-delete" type="submit">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">Aucun produit enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection