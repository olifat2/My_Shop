@extends('layouts.app')

@section('content')
<!-- Hero Section with Carousel -->
<section class="hero-section">
    <h1 class="homepage-title">Bienvenue sur MyShop - Soins capillaires et extensions de qualité</h1>

    <div class="carousel-container">
        <div class="slides">
            <div class="slide active">
                <img src="{{ asset('img/intro.png') }}" alt="Produits en vedette - Offres spéciales">
                <div class="slide-info">
                    <h2>Produit en vedette</h2>
                    <p>Découvrez nos offres spéciales du moment !</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg1Hover.png') }}" alt="Extensions naturelles 100% - Prix réduit">
                <div class="slide-info">
                    <h2>Extensions naturelles</h2>
                    <p>Des mèches 100% naturelles à prix réduit.</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg2Hover.png') }}" alt="Huiles capillaires premium">
                <div class="slide-info">
                    <h2>Huiles capillaires</h2>
                    <p>Pour des cheveux brillants et forts.</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
                </div>
            </div>
            <div class="slide">
                <img src="{{ asset('img/bodyImg3Hover.png') }}" alt="Accessoires capillaires tendance">
                <div class="slide-info">
                    <h2>Accessoires tendance</h2>
                    <p>Peignes, brosses, bonnets et plus encore !</p>
                    <a href="{{ route('client.index') }}" class="btn btn-primary">Voir les produits</a>
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
    <div class="trust container">
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
                <a href="{{ route('client.index') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">💆</div>
                <h3>Visage</h3>
                <p>Produits de soin du visage</p>
                <a href="{{ route('client.index') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">🧴</div>
                <h3>Corps</h3>
                <p>Soins du corps complets</p>
                <a href="{{ route('client.index') }}" class="category-link">Découvrir →</a>
            </div>
            <div class="category-card">
                <div class="category-icon">💄</div>
                <h3>Maquillage</h3>
                <p>Maquillage professionnel</p>
                <a href="{{ route('client.index') }}" class="category-link">Découvrir →</a>
            </div>
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
            <button type="submit" class="btn">S'inscrire</button>
        </form>
    </div>
</section>
@endsection