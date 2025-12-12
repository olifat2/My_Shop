@extends('layouts.app')

@section('content')
<h1 class="title-page">Bienvenue dans notre boutique</h1>

<p class="description-page">
    Découvrez nos produits de qualité au meilleur prix.
</p>

<div class="container-products">
    <h2 class="container-title">Produits récents</h2>

    <div class="divider"></div>

    <div class="products-grid">
        @foreach($products as $product)
        <div class="products-card">
            <h3 class="products-title">
                {{ $product->categorie === 'produit_capillaire' ? $product->produitCapillaire->nom : $product->mecheExtension->style }}
            </h3>
            <p class="products-price">
                {{ $product->prix_unitaire }} F CFA
            </p>
            <a href="{{ route('client.product.show', $product) }}" class="btn-product product-show">
                Voir détails
            </a>
        </div>
        @endforeach
    </div>

    <div class="divider"></div>

    <div class="container-products-actions">
        <p>
            <a href="{{ route('client.catalogue') }}" class="btn-product product-catalog">
                Voir tout le catalogue
            </a>
        </p>
    </div>
</div>
@endsection