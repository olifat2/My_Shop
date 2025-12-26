<header class="navbar" role="banner">
    <div class="nav-logo">
        @auth
        <a href="{{ route('client.accueil') }}">myshop</a>
        @else
        <a href="{{ route('accueil') }}">myshop</a>
        @endauth
    </div>

    <button class="nav-toggle" id="nav-toggle" aria-controls="nav-menu" aria-expanded="false" aria-label="Ouvrir le menu">
        <span class="hamburger" aria-hidden="true"></span>
    </button>

    <nav class="nav-menu" id="nav-menu" role="navigation">
        <ul class="nav-links" id="nav-links">
            @auth
            <li><a href="{{ route('client.accueil') }}">Accueil</a></li>
            <li><a href="{{ route('client.index') }}">Produits</a></li>
            @else
            <li><a href="{{ route('accueil') }}">Accueil</a></li>
            <li><a href="{{ route('catalogue') }}">Produits</a></li>
            @endauth
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                    Catégories <span class="arrow">▾</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Cheveux</a></li>
                    <li><a href="#">Visage</a></li>
                    <li><a href="#">Corps</a></li>
                    <li><a href="#">Maquillage</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="user-header-actions">
        <form class="search-form" action="#" method="get" role="search">
            <input id="header-search" name="q" type="search" placeholder="Rechercher des produits..." aria-label="Rechercher des produits">
            <button type="submit" class="btn-header-search" aria-label="Rechercher">🔍</button>
        </form>

        @auth
        <a href="{{ route('client.cart') }}" class="cart-link">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M6 6H4V4H6V6Z" fill="currentColor" opacity="0" />
                <path d="M7 4H3V6H5L8 14H19V12H9.42L8.2 8H20V6H8.6L8 4H7Z" fill="currentColor" />
                <circle cx="10" cy="20" r="1" fill="currentColor" />
                <circle cx="18" cy="20" r="1" fill="currentColor" />
            </svg>
            @php
            $cartCount = collect(session('cart', []))->sum('qty');
            @endphp

            @if($cartCount > 0)
            <span class="cart-count">{{ $cartCount }}</span>
            @endif
        </a>
        @endauth
        @auth
        <form class="first-form" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn-header-first btn-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M16 13v-2H7V8l-5 4 5 4v-3h9z" fill="currentColor" />
                    <path d="M20 3H4a1 1 0 00-1 1v4h2V5h14v14H5v-3H3v4a1 1 0 001 1h16a1 1 0 001-1V4a1 1 0 00-1-1z" fill="currentColor" opacity="0.9" />
                </svg>
                <span>Déconnexion</span>
            </button>
        </form>

        <form class="second-form" action="{{ route('client.dashboard') }}" method="get">
            @csrf
            <button type="submit" class="btn-header-second btn-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM2 20a10 10 0 0120 0H2z" fill="currentColor" />
                </svg>
                <span>Mon compte</span>
            </button>
        </form>
        @else
        <form class="first-form" action="{{ route('login.form') }}" method="get">
            @csrf
            <button type="submit" class="btn-header-first btn-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M15 3H5a2 2 0 00-2 2v14h2V5h10V3z" fill="currentColor" />
                    <path d="M21 12l-4-4v3h-5v2h5v3l4-4z" fill="currentColor" />
                </svg>
                <span>Se connecter</span>
            </button>
        </form>

        <form class="second-form" action="{{ route('register.form') }}" method="get">
            @csrf
            <button type="submit" class="btn-header-second btn-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M12 12a5 5 0 100-10 5 5 0 000 10z" fill="currentColor" />
                    <path d="M2 20a10 10 0 0120 0H2z" fill="currentColor" opacity="0.9" />
                </svg>
                <span>S'inscrire</span>
            </button>
        </form>
        @endauth
    </div>
</header>