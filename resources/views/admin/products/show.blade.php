@extends('layouts.auth-admin.app')

@section('content')
<div class="admin-container">
    <div class="dashboard-header">
        <div>
            <h1>Détails du produit</h1>
            <p class="subtitle">...</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>
    <div class="card-detail-product">
        <div class="divider first"></div>

        <div class="info-product">
            <h1 class="title-product">
                {{ $product->categorie === 'produit_capillaire' ? $product->produitCapillaire->nom : $product->mecheExtension->style }}
            </h1>
            <div class="info-product-details">
                <p class="category-product">
                    <strong>Catégorie :</strong> {{ ucfirst(str_replace('_', ' / ', $product->categorie)) }}
                </p>
                <p><strong>Prix unitaire :</strong> {{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA</p>
                <p><strong>Quantité en stock :</strong> {{ optional($product->stock->first())->quantite ?? 'Non défini' }}</p>
                <p><strong>Poids :</strong> {{ $product->poids }} g</p>
            </div>
        </div>

        <div class="divider second"></div>

        @if ($product->categorie === 'meche_extension')
        <div class="section-detail">
            <h4>Caractéristiques de la mèche/extension</h4>
            <ul>
                <li><strong>Marque :</strong> {{ $product->mecheExtension->marque }}</li>
                <li><strong>Style :</strong> {{ $product->mecheExtension->style }}</li>
                <li><strong>Technique de pose :</strong> {{ $product->mecheExtension->techniquePose->nom }}</li>
                <li><strong>PCS :</strong> {{ $product->mecheExtension->pcs }}</li>
                <li><strong>Hauteur :</strong> {{ $product->mecheExtension->height }} cm</li>
            </ul>
        </div>
        @elseif ($product->categorie === 'produit_capillaire')
        <div class="section-detail">
            <h4>Caractéristiques du produit capillaire</h4>
            <ul>
                <li><strong>Nom :</strong> {{ $product->produitCapillaire->nom }}</li>
                <li><strong>Effet :</strong> {{ $product->produitCapillaire->effet->nom }}</li>
                <li><strong>Nature de l’action :</strong> {{ $product->produitCapillaire->natureAction->nom }}</li>
                <li><strong>Volume :</strong> {{ $product->produitCapillaire->volume }} ml</li>
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection