<!-- ================= ADMIN TOPBAR ================= -->
<nav class="admin-topbar" role="navigation" aria-label="Barre supérieure admin">
    <div class="topbar-left">
        <button
            type="button"
            class="icon-btn toggle-sidebar"
            id="toggleSidebar"
            aria-label="Ouvrir le menu de navigation"
            aria-controls="adminSidebar"
            aria-expanded="false">
            ☰
        </button>

        <a href="{{ route('admin.dashboard') }}" class="admin-brand">
            <span class="brand-icon" aria-hidden="true">🏪</span>
            <span class="brand-text">MyShop</span>
            <span class="brand-sub">Admin</span>
        </a>
    </div>

    <div class="topbar-search" role="search">
        <input
            type="search"
            class="search-input"
            placeholder="Rechercher commandes, clients..."
            aria-label="Recherche globale"
            autocomplete="off">
    </div>

    <div class="topbar-right">
        <!-- Notifications -->
        <button
            type="button"
            class="icon-btn notification-btn"
            title="Notifications"
            aria-label="Voir les notifications"
            aria-haspopup="true">
            🔔
            <span class="badge" aria-hidden="true">3</span>
            <span class="sr-only">3 nouvelles notifications</span>
        </button>

        <!-- Theme toggle -->
        <button
            type="button"
            class="icon-btn theme-toggle"
            id="themeToggle"
            aria-label="Changer le thème"
            title="Changer le thème"
            aria-pressed="false"
            aria-controls="ThemeOptions">
            <span class="theme-icon" data-light aria-hidden="true">🌞</span>
            <span class="theme-icon" data-dark aria-hidden="true">🌙</span>
        </button>

        <!-- Profile -->
        <div class="profile-menu">
            <button
                type="button"
                class="profile-btn"
                id="profileToggle"
                aria-haspopup="true"
                aria-controls="profileDropdown"
                aria-expanded="false">
                <img
                    src="{{ asset('img/avatar.jpg') }}"
                    alt="Avatar utilisateur"
                    class="avatar-mini">
                <span class="user-name">{{ Auth::user()->firstname }}</span>
                <span class="chevron" aria-hidden="true">▾</span>
            </button>

            <div
                class="dropdown-content"
                id="profileDropdown"
                role="menu"
                aria-label="Menu utilisateur"
                aria-hidden="true">

                <button class="dropdown-item" role="menuitem">Mon profil</button>
                <button class="dropdown-item" role="menuitem">Paramètres</button>

                <div class="dropdown-divider" role="separator"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="dropdown-item logout-btn"
                        role="menuitem">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- ================= SIDEBAR ================= -->
<nav
    class="admin-sidebar"
    id="adminSidebar"
    role="navigation"
    aria-label="Navigation principale admin">

    <div class="sidebar-header">
        <h3>Navigation</h3>
        <button
            type="button"
            class="icon-btn close-sidebar"
            id="closeSidebar"
            aria-label="Fermer le menu">
            ✕
        </button>
    </div>

    <nav class="sidebar-nav" aria-label="Barre latérale admin">
        <div class="nav-section">
            <p class="nav-section-title">Gestion</p>

            <ul class="nav-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">📊</span>
                        <span class="nav-text">Tableau de bord</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">📋</span>
                        <span class="nav-text">Commandes</span>

                        @if(($newOrdersCount ?? 0) > 0)
                        <span class="nav-badge">{{ $newOrdersCount }}</span>
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">📦</span>
                        <span class="nav-text">Produits</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.clients.index') }}"
                        class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <span class="nav-icon" aria-hidden="true">👥</span>
                        <span class="nav-text">Clients</span>

                        @if(($newClientsCount ?? 0) > 0)
                        <span class="nav-badge">{{ $newClientsCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</nav>

<!-- ================= OVERLAY ================= -->
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
    tabindex="-1"
    aria-hidden="true">
</div>
