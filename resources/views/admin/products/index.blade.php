@extends('layouts.auth-admin.app')

@section('content')
<div class="admin-container-index">
    <div class="dashboard-header">
        <div>
            <h1>Produits</h1>
            <p class="subtitle">Bienvenue ! Voici la liste de tous vos produits</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Nouveau produit</a>
        </div>
    </div>

    <div class="product-filters">
        <div class="filter-group">
            <input
                type="search"
                id="productSearch"
                placeholder="Rechercher un produit..."
                class="filter-input"
                aria-label="Recherche produit">
        </div>

        <div class="filter-group">
            <select id="categoryFilter" class="filter-select" aria-label="Filtrer par catégorie">
                <option value="">Toutes les catégories</option>
                <option value="produit_capillaire">Produits capillaires</option>
                <option value="meche_extension">Mèches & extensions</option>
            </select>
        </div>

        <div class="filter-group">
            <select id="stockFilter" class="filter-select">
                <option value="">Tous les stocks</option>
                <option value="in">En stock</option>
                <option value="low">Stock faible</option>
                <option value="out">Rupture</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table-product">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identification</th>
                    <th>Prix (FCFA)</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                @php $qty = $product->stock->sum('quantite'); @endphp
                <tr
                    data-name="{{
                        strtolower($product->categorie === 'produit_capillaire'
                            ? $product->produitCapillaire->nom
                            : $product->mecheExtension->style)
                    }}"
                    data-category="{{ $product->categorie }}"
                    data-stock="{{ $product->stock->sum('quantite') }}">
                    <td data-label="#">{{ $loop->iteration }}</td>
                    <td data-label="Produit">
                        {{
                            $product->categorie === 'produit_capillaire'
                                ? $product->produitCapillaire->nom
                                : $product->mecheExtension->style
                        }}
                    </td>
                    <td data-label="Prix">
                        {{ number_format($product->prix_unitaire, 0, ',', ' ') }}
                    </td>
                    <td data-label="Stock">
                        <span class="stock-badge {{ $qty > 10 ? 'stock-high' : ($qty > 0 ? 'stock-medium' : 'stock-low') }}">
                            {{ $qty }}
                        </span>
                    </td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action btn-view" title="Voir">👁️</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit" title="Modifier">✏️</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Aucun produit enregistré.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
</div>
@endsection