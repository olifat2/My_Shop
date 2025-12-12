@extends('layouts.app')

@section('content')
<!-- Hero Section with Carousel -->
<section class="hero-section">
    <h1 class="visually-hidden">Bienvenue sur MyShop - Soins capillaires et extensions de qualité</h1>

    <div class="carousel-container">
        <div class="slides">
            <div class="slide active">
                <img src="{{ asset('img/intro.png') }}" alt="Produits en vedette - Offres spéciales">
                <div class="slide-info">
                    <h2>Produit en vedette</h2>
                    <p>Découvrez nos offres spéciales du moment !</p>
                    <a href="{{ route('client.catalogue') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg1Hover.png') }}" alt="Extensions naturelles 100% - Prix réduit">
                <div class="slide-info">
                    <h2>Extensions naturelles</h2>
                    <p>Des mèches 100% naturelles à prix réduit.</p>
                    <a href="{{ route('client.catalogue') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg2Hover.png') }}" alt="Huiles capillaires premium">
                <div class="slide-info">
                    <h2>Huiles capillaires</h2>
                    <p>Pour des cheveux brillants et forts.</p>
                    <a href="{{ route('client.catalogue') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg3Hover.png') }}" alt="Accessoires capillaires tendance">
                <div class="slide-info">
                    <h2>Accessoires tendance</h2>
                    <p>Peignes, brosses, bonnets et plus encore !</p>
                    <a href="{{ route('client.catalogue') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
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
<section class="trust-elements">
    <div class="trust-container">
        <div class="trust-item">
            <div class="trust-icon">📦</div>
            <h3>Livraison gratuite</h3>
            <p>Pour toute commande supérieure à 50€</p>
        </div>
        <div class="trust-item">
            <div class="trust-icon">🔄</div>
            <h3>Retours faciles</h3>
            <p>30 jours pour changer d'avis</p>
        </div>
        <div class="trust-item">
            <div class="trust-icon">🛡️</div>
            <h3>Paiement sécurisé</h3>
            <p>Vos données sont protégées</p>
        </div>
        <div class="trust-item">
            <div class="trust-icon">⭐</div>
            <h3>Qualité garantie</h3>
            <p>Produits vérifiés et testés</p>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <h2>Parcourez nos catégories</h2>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-icon">💇</div>
                <h3>Cheveux</h3>
                <p>Extensions et soins capillaires</p>
                <a href="{{ route('client.catalogue') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">💆</div>
                <h3>Visage</h3>
                <p>Produits de soin du visage</p>
                <a href="{{ route('client.catalogue') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">🧴</div>
                <h3>Corps</h3>
                <p>Soins du corps complets</p>
                <a href="{{ route('client.catalogue') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">💄</div>
                <h3>Maquillage</h3>
                <p>Maquillage professionnel</p>
                <a href="{{ route('client.catalogue') }}" class="category-link">Découvrir →</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products-section">
    <div class="container">
        <h2>Produits en vedette</h2>
        <p class="section-subtitle">Découvrez nos meilleurs ventes et nouveautés</p>

        <div class="products-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('img/intro.png') }}" alt="Produit 1">
                    <span class="product-badge">Nouveau</span>
                </div>
                <div class="product-info">
                    <h3>Mèches naturelles Premium</h3>
                    <p class="product-category">Extensions capillaires</p>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-count">(24 avis)</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">89.99€</span>
                        <a href="{{ route('client.catalogue') }}" class="btn-add">Ajouter au panier</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('img/bodyImg1Hover.png') }}" alt="Produit 2">
                    <span class="product-badge promo">-20%</span>
                </div>
                <div class="product-info">
                    <h3>Huile capillaire régénérante</h3>
                    <p class="product-category">Soins capillaires</p>
                    <div class="product-rating">
                        <span class="stars">★★★★☆</span>
                        <span class="rating-count">(18 avis)</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">34.99€</span>
                        <a href="{{ route('client.catalogue') }}" class="btn-add">Ajouter au panier</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('img/bodyImg2Hover.png') }}" alt="Produit 3">
                    <span class="product-badge">Populaire</span>
                </div>
                <div class="product-info">
                    <h3>Brosse démêlante professionnelle</h3>
                    <p class="product-category">Accessoires</p>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-count">(42 avis)</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">24.99€</span>
                        <a href="{{ route('client.catalogue') }}" class="btn-add">Ajouter au panier</a>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ asset('img/bodyImg3Hover.png') }}" alt="Produit 4">
                </div>
                <div class="product-info">
                    <h3>Bonnet en soie premium</h3>
                    <p class="product-category">Accessoires</p>
                    <div class="product-rating">
                        <span class="stars">★★★★★</span>
                        <span class="rating-count">(31 avis)</span>
                    </div>
                    <div class="product-footer">
                        <span class="product-price">19.99€</span>
                        <a href="{{ route('client.catalogue') }}" class="btn-add">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="view-all-container">
            <a href="{{ route('client.catalogue') }}" class="btn btn-primary btn-large">Voir tous les produits →</a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="newsletter-content">
        <h2>Restez informé de nos offres</h2>
        <p>Inscrivez-vous à notre newsletter pour recevoir les dernières nouveautés et offres exclusives</p>
        <form class="newsletter-form" action="#" method="post">
            @csrf
            <input type="email" name="email" placeholder="Votre email..." required aria-label="Votre email">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</section>

@endsection