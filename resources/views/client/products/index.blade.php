@extends('layouts.app')

@section('content')

<div class="view-products">

    <!-- Section titre et description -->
    <div class="section-title">
        <h1 class="title">Nos produits pour cheveux et soins capillaires</h1>
        <p class="description">
            Nous mettons à votre disposition des produits capillaires de qualité, adaptés à tous types de cheveux.
            Chaque produit est soigneusement sélectionné pour garantir durabilité, performance et satisfaction totale.
        </p>
    </div>

    <div class="container">

        <!-- Section des produits en vedette -->
        <div class="featured-products-header">
            <h2>Produits en vedette</h2>
            <p class="section-subtitle">Découvrez nos meilleures ventes et nouveautés</p>
        </div>

        <div class="catalogue-filters">
            <input type="text" id="productSearch" placeholder="Rechercher un produit..." aria-label="Recherche produit">

            <select id="categoryFilter" aria-label="Filtrer par catégorie">
                <option value="">Toutes les catégories</option>
                <option value="produit_capillaire">Produits capillaires</option>
                <option value="meche_extension">Meches et extensions</option>
                <!-- Ajouter d'autres catégories si nécessaire -->
            </select>
        </div>

        <!-- Grille des produits -->
        <div class="products-grid">
            @forelse ($products as $item)
            <article class="product-card" data-id="{{ $item->id }}" data-category="{{ $item->categorie }}" data-name="{{ $item->categorie === 'produit_capillaire' ? $item->produitCapillaire->nom : $item->mecheExtension->style }}">

                <!-- Image produit -->
                <div class="product-image">
                    <img src="{{ asset('img/intro.png') }}" alt="{{ $item->categorie === 'produit_capillaire' ? $item->produitCapillaire->nom : $item->mecheExtension->style }}" loading="lazy">
                    <span class="product-badge">Nouveau</span>
                </div>

                <!-- Informations produit -->
                <div class="product-info">
                    <h3>{{ $item->categorie === 'produit_capillaire' ? $item->produitCapillaire->nom : $item->mecheExtension->style }}</h3>
                    <p class="product-category">{{ $item->categorie === 'produit_capillaire' ? ucfirst(str_replace('_', ' ', $item->categorie)) : ucfirst(str_replace('_', ' et ', $item->categorie)) }}</p>

                    <!-- Note produit -->
                    <div class="product-rating" aria-label="Note produit 5 étoiles">
                        <span class="stars" aria-hidden="true">★★★★★</span>
                        <span class="rating-count">(24 avis)</span>
                    </div>

                    <!-- Footer produit: prix + ajout au panier -->
                    <div class="product-footer">
                        <span class="product-price">{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</span>
                        <form action="{{ route('client.cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add" aria-label="Ajouter au panier">
                                Ajouter au panier
                            </button>
                        </form>
                        {{-- Bouton Voir le produit / Détails --}}
                        @auth
                        <a href="{{ route('client.product.show', $item->id) }}" class="btn" aria-label="Voir le produit">
                            Voir le produit
                        </a>
                        @else
                        <a href="{{ route('product.show', $item->id) }}" class="btn" aria-label="Voir le produit">
                            Voir le produit
                        </a>
                        @endauth
                    </div>
                </div>
            </article>
            @empty
            <p>Aucun produit disponible.</p>
            @endforelse
        </div>

        <!-- Bouton voir tous les produits -->
        <div class="view-all-container">
            <a href="{{ route('catalogue') }}" class="btn btn-primary btn-large" aria-label="Voir tous les produits">
                Voir tous les produits
            </a>
        </div>

    </div>
</div>

@endsection