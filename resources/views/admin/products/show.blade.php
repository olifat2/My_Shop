@extends('layouts.auth-admin.app')

@section('content')
<div>

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Détails du produit</h1>
            <p class="subtitle">
                Informations complètes sur le produit sélectionné
            </p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    <!-- Carte principale -->
    <div class="card-detail-product">

        <!-- En-tête produit -->
        <div class="product-header">
            <h2 class="product-title">
                {{ $product->categorie === 'produit_capillaire'
                    ? $product->produitCapillaire->nom
                    : $product->mecheExtension->style }}
            </h2>
            <span class="product-category">
                {{ ucfirst(str_replace('_', ' / ', $product->categorie)) }}
            </span>
        </div>

        <div class="divider"></div>

        <!-- Informations générales -->
        <div class="product-info-grid">
            <div class="info-item">
                <span class="label">Prix unitaire</span>
                <span class="value">{{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA</span>
            </div>

            <div class="info-item">
                <span class="label">Stock disponible</span>
                <span class="value">
                    {{ optional($product->stock->first())->quantite ?? 'Non défini' }}
                </span>
            </div>

            <div class="info-item">
                <span class="label">Poids</span>
                <span class="value">{{ $product->poids }} g</span>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Détails spécifiques -->
        @if ($product->categorie === 'meche_extension')
        <div class="section-detail">
            <h3>Caractéristiques de la mèche / extension</h3>
            <ul class="detail-list">
                <li><strong>Marque :</strong> {{ $product->mecheExtension->marque }}</li>
                <li><strong>Style :</strong> {{ $product->mecheExtension->style }}</li>
                <li><strong>Technique de pose :</strong> {{ $product->mecheExtension->techniquePose->nom }}</li>
                <li><strong>PCS :</strong> {{ $product->mecheExtension->pcs }}</li>
                <li><strong>Hauteur :</strong> {{ $product->mecheExtension->height }} cm</li>
            </ul>
        </div>

        @elseif ($product->categorie === 'produit_capillaire')
        <div class="section-detail">
            <h3>Caractéristiques du produit capillaire</h3>
            <ul class="detail-list">
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