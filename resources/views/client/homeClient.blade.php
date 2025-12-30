@extends('layouts.app')

@section('content')

<!-- Hero Section with Carousel -->
<section class="hero-section" aria-label="Section principale avec carousel de produits vedettes">
    <h1 class="homepage-title">Bienvenue sur MyShop - Soins capillaires et extensions de qualité</h1>

    <div class="carousel-container">
        <div class="slides">
            <article class="slide active">
                <img src="{{ asset('img/intro.png') }}" alt="Produits en vedette - Offres spéciales" loading="lazy">
                <div class="slide-info">
                    <h2>Produit en vedette</h2>
                    <p>Découvrez nos offres spéciales du moment !</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary" aria-label="Voir les produits en vedette">Voir les produits</a>
                </div>
            </article>
            <article class="slide">
                <img src="{{ asset('img/bodyImg1Hover.png') }}" alt="Extensions naturelles 100%" loading="lazy">
                <div class="slide-info">
                    <h2>Extensions naturelles</h2>
                    <p>Des mèches 100% naturelles à prix réduit.</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary" aria-label="Voir les extensions naturelles">Voir les extensions naturelles</a>
                </div>
            </article>
            <article class="slide">
                <img src="{{ asset('img/bodyImg2Hover.png') }}" alt="Huiles capillaires premium" loading="lazy">
                <div class="slide-info">
                    <h2>Huiles capillaires</h2>
                    <p>Pour des cheveux brillants et forts.</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary" aria-label="Voir les huiles capillaires">Voir les huiles capillaires</a>
                </div>
            </article>
            <article class="slide">
                <img src="{{ asset('img/bodyImg3Hover.png') }}" alt="Accessoires capillaires tendance" loading="lazy">
                <div class="slide-info">
                    <h2>Accessoires tendance</h2>
                    <p>Peignes, brosses, bonnets et plus encore !</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary" aria-label="Voir les accessoires capillaires">Voir les accessoires capillaires</a>
                </div>
            </article>
        </div>
        <button class="prev" aria-label="Diapositive précédente">&#10094;</button>
        <button class="next" aria-label="Diapositive suivante">&#10095;</button>

        <div class="carousel-dots">
            <span class="dot active" data-index="0" aria-label="Slide 1"></span>
            <span class="dot" data-index="1" aria-label="Slide 2"></span>
            <span class="dot" data-index="2" aria-label="Slide 3"></span>
            <span class="dot" data-index="3" aria-label="Slide 4"></span>
        </div>
    </div>
</section>

<!-- Trust Elements Section -->
<section class="trust-elements" aria-label="Garanties et services MyShop">
    <div class="trust container">
        <article class="trust-item">
            <div class="trust-icon" aria-hidden="true">📦</div>
            <h3>Livraison gratuite</h3>
            <p>Pour toute commande supérieure à 50€</p>
        </article>
        <article class="trust-item">
            <div class="trust-icon" aria-hidden="true">🔄</div>
            <h3>Retours faciles</h3>
            <p>30 jours pour changer d'avis</p>
        </article>
        <article class="trust-item">
            <div class="trust-icon" aria-hidden="true">🛡️</div>
            <h3>Paiement sécurisé</h3>
            <p>Vos données sont protégées</p>
        </article>
        <article class="trust-item">
            <div class="trust-icon" aria-hidden="true">⭐</div>
            <h3>Qualité garantie</h3>
            <p>Produits vérifiés et testés</p>
        </article>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section" aria-label="Catégories de produits">
    <div class="container">
        <h2>Parcourez nos catégories</h2>
        <div class="categories-grid">
            <article class="category-card">
                <div class="category-icon" aria-hidden="true">💇</div>
                <h3>Cheveux</h3>
                <p>Extensions et soins capillaires</p>
                <a href="{{ route('client.index') }}" class="category-link" aria-label="Découvrir les produits Cheveux">Découvrir les produits cheveux</a>
            </article>
            <article class="category-card">
                <div class="category-icon" aria-hidden="true">💆</div>
                <h3>Visage</h3>
                <p>Produits de soin du visage</p>
                <a href="{{ route('client.index') }}" class="category-link" aria-label="Découvrir les produits Visage">Découvrir les produits visage</a>
            </article>
            <article class="category-card">
                <div class="category-icon" aria-hidden="true">🧴</div>
                <h3>Corps</h3>
                <p>Soins du corps complets</p>
                <a href="{{ route('client.index') }}" class="category-link" aria-label="Découvrir les produits Corps">Découvrir les produits corps</a>
            </article>
            <article class="category-card">
                <div class="category-icon" aria-hidden="true">💄</div>
                <h3>Maquillage</h3>
                <p>Maquillage professionnel</p>
                <a href="{{ route('client.index') }}" class="category-link" aria-label="Découvrir les produits Maquillage">Découvrir les produits maquillage</a>
            </article>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products-section" aria-label="Produits en vedette">
    <div class="container">
        <h2>Produits en vedette</h2>
        <p class="section-subtitle">Découvrez nos meilleurs ventes et nouveautés</p>

        <div class="products-grid homeClient">
            @forelse ($highItems->take(4) as $item)
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
                    <div class="product-note">
                        <div class="product-rating" aria-label="Note produit 5 étoiles">
                            <span class="stars" aria-hidden="true">★★★★★</span>
                            <span class="rating-count">(24 avis)</span>
                        </div>
                        <div class="product-price">
                            <span>{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>

                    <!-- Footer produit: prix + ajout au panier -->
                    <div class="product-footer">
                        <form action="{{ route('client.cart.add', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-add" aria-label="Ajouter au panier">
                                Ajouter au panier
                            </button>
                        </form>
                        {{-- Bouton Voir le produit / Détails --}}
                        <a href="{{ route('client.product.show', $item->id) }}" class="btn btn-secondary" aria-label="Voir le produit">
                            Voir le produit
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <p>Aucun produit</p>
            @endforelse
        </div>

        <div class="view-all-container">
            <a href="{{ route('catalogue') }}" class="btn btn-primary" aria-label="Voir tous les produits">Voir tous les produits</a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section" aria-label="Newsletter MyShop">
    <div class="newsletter-content">
        <h2>Restez informé de nos offres</h2>
        <p>Inscrivez-vous à notre newsletter pour recevoir les dernières nouveautés et offres exclusives</p>
        <form class="newsletter-form" action="#" method="post">
            @csrf
            <input type="email" name="email" placeholder="Votre email..." required aria-label="Votre email">
            <button type="submit" class="btn" aria-label="S'inscrire à la newsletter">S'inscrire</button>
        </form>
    </div>
</section>

@endsection