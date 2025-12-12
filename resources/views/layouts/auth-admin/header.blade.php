<!-- Admin Topbar -->
<nav class="admin-topbar">
    <div class="topbar-left">
        <button class="toggle-sidebar" id="toggleSidebar" aria-label="Menu">☰</button>
        <a href="{{ route('admin.dashboard') }}" class="admin-brand">
            <span class="brand-icon">🏪</span>
            <span class="brand-text">MyShop Admin</span>
        </a>
    </div>

    <div class="topbar-search">
        <input type="text" placeholder="Rechercher..." class="search-input" id="searchInput">
        <button class="search-btn">🔍</button>
    </div>

    <div class="topbar-right">
        <div class="notification-icon">
            <button class="icon-btn" title="Notifications">🔔
                <span class="badge">3</span>
            </button>
        </div>
        <div class="profile-menu">
            <button class="profile-btn" id="profileToggle">
                <img src="{{ asset('img/avatar.jpg') }}" alt="Profil" class="avatar-mini">
                <span class="user-name">{{ Auth::user()->firstname }}</span>
                <span class="chevron">▼</span>
            </button>
            <div class="dropdown-content" id="profileDropdown">
                <a href="#" class="dropdown-item">👤 Mon profil</a>
                <a href="#" class="dropdown-item">⚙️ Paramètres</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="dropdown-item logout-btn">🚪 Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar Navigation -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h3>Menu</h3>
        <button class="close-sidebar" id="closeSidebar" aria-label="Fermer">✕</button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Gestion</div>
            <ul class="nav-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <span class="nav-icon">📊</span>
                        <span class="nav-text">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <span class="nav-icon">📋</span>
                        <span class="nav-text">Commandes</span>
                        <span class="nav-badge">12</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <span class="nav-icon">📦</span>
                        <span class="nav-text">Produits</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                        <span class="nav-icon">👥</span>
                        <span class="nav-text">Clients</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Rapports</div>
            <ul class="nav-menu">
                <li>
                    <a href="#" class="nav-link">
                        <span class="nav-icon">📈</span>
                        <span class="nav-text">Ventes</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link">
                        <span class="nav-icon">💰</span>
                        <span class="nav-text">Revenus</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Paramètres</div>
            <ul class="nav-menu">
                <li>
                    <a href="#" class="nav-link">
                        <span class="nav-icon">⚙️</span>
                        <span class="nav-text">Configuration</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>

<!-- Overlay for mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script>
    // Toggle sidebar
    const toggleBtn = document.getElementById('toggleSidebar');
    const closeBtn = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.add('open');
        overlay.classList.add('show');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });

    // Profile dropdown
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');

    profileToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        profileDropdown.classList.toggle('active');
    });

    document.addEventListener('click', () => {
        profileDropdown.classList.remove('active');
    });

    profileDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
    });
</script>