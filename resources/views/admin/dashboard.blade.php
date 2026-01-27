@extends('layouts.auth-admin.app')

@section('title', 'Tableau de bord administrateur')

@section('content')
<main class="admin-container">

    <!-- ===== DASHBOARD HEADER ===== -->
    <header class="dashboard-header">
        <div>
            <h1>Tableau de bord</h1>
            <p class="subtitle">
                Bienvenue ! Voici un aperçu de votre boutique
            </p>
        </div>

        <nav class="header-actions-dash" aria-label="Actions rapides">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                Nouveau produit
            </a>
        </nav>
    </header>

    <!-- ===== STATISTICS ===== -->
    <section class="stats-grid" aria-label="Statistiques générales">

        <article class="stat-card">
            <header class="stat-header">
                <span class="stat-icon" aria-hidden="true">📦</span>
                <span class="stat-badge">+{{ rand(1, 5) }}%</span>
            </header>
            <div class="stat-body">
                <h3>Produits</h3>
                <p class="stat-value">{{ $totalProducts }}</p>
                <p class="stat-label">produits actifs</p>
            </div>
        </article>

        <article class="stat-card">
            <header class="stat-header">
                <span class="stat-icon" aria-hidden="true">📋</span>
                <span class="stat-badge">+{{ rand(2, 8) }}%</span>
            </header>
            <div class="stat-body">
                <h3>Commandes</h3>
                <p class="stat-value">{{ $totalOrders }}</p>
                <p class="stat-label">ce mois</p>
            </div>
        </article>

        <article class="stat-card">
            <header class="stat-header">
                <span class="stat-icon" aria-hidden="true">👥</span>
                <span class="stat-badge">+{{ rand(3, 12) }}%</span>
            </header>
            <div class="stat-body">
                <h3>Clients</h3>
                <p class="stat-value">{{ $totalClients }}</p>
                <p class="stat-label">clients actifs</p>
            </div>
        </article>

        <article class="stat-card">
            <header class="stat-header">
                <span class="stat-icon" aria-hidden="true">💰</span>
                <span class="stat-badge">+{{ rand(5, 15) }}%</span>
            </header>
            <div class="stat-body">
                <h3>Revenu</h3>
                <p class="stat-value">
                    {{ number_format($orders->sum('total'), 0, ',', ' ') }} FCFA
                </p>
                <p class="stat-label">ce mois</p>
            </div>
        </article>

    </section>

    <!-- ===== MAIN CONTENT ===== -->
    <section class="dashboard-layout">

        <!-- ===== MAIN AREA ===== -->
        <section class="dashboard-main">

            <!-- ===== SECTION : MÈCHES & EXTENSIONS ===== -->
            <section class="dashboard-section">
                <header class="section-header">
                    <h2>Mèches & Extensions</h2>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        Voir tous
                    </a>
                </header>

                <div class="table-responsive">
                    <table class="table-product">
                        <caption class="sr-only">
                            Liste des mèches et extensions récentes
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col">Nature</th>
                                <th scope="col">Marque</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Date ajout</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestProductsMeche as $product)
                            @php $qty = $product->stock->sum('quantite'); @endphp
                            <tr>
                                <td data-label="Nature">
                                    <span class="cell-label">
                                        {{ $product->mecheExtension->nature }}
                                    </span>
                                </td>
                                <td data-label="Marque">
                                    <span class="cell-brand">
                                        {{ ucfirst($product->mecheExtension->marque) }}
                                    </span>
                                </td>
                                <td data-label="Prix">
                                    <span class="cell-price">
                                        {{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA
                                    </span>
                                </td>
                                <td data-label="Stock">
                                    <span class="stock-badge {{ $qty > 10 ? 'stock-high' : ($qty > 0 ? 'stock-medium' : 'stock-low') }}">
                                        {{ $qty }} unités
                                    </span>
                                </td>
                                <td data-label="Date ajout">
                                    <time datetime="{{ $product->created_at->toDateString() }}">
                                        {{ $product->created_at->format('d/m/Y') }}
                                    </time>
                                </td>
                                <td data-label="Actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action btn-view" aria-label="Voir le produit">👁️</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit" aria-label="Modifier le produit">✏️</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" aria-label="Supprimer le produit" onclick="return confirm('Êtes-vous sûr ?')">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">📭 Aucun produit récent</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Section Produits Capillaires -->
            <section class="dashboard-section">
                <div class="section-header">
                    <h2>Produits Capillaires</h2>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        Voir tous
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table-product">
                        <caption class="sr-only">
                            Liste des produits capillaires récents
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col">Effet</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Date ajout</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestProductsCapillaire as $product)
                            <tr>
                                <td data-label="Effet">
                                    <span class="cell-label">
                                        {{ $product->produitCapillaire->effet->nom }}
                                    </span>
                                </td>
                                <td data-label="Nom">
                                    <span class="cell-brand">
                                        {{ ucfirst($product->produitCapillaire->nom) }}
                                    </span>
                                </td>
                                <td data-label="Prix">
                                    <span class="cell-price">
                                        {{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA
                                    </span>
                                </td>
                                <td data-label="Stock">
                                    <span class="stock-badge {{ $product->stock->sum('quantite') > 10 ? 'stock-high' : ($product->stock->sum('quantite') > 0 ? 'stock-medium' : 'stock-low') }}">
                                        {{ $product->stock->sum('quantite') }} unités
                                    </span>
                                </td>
                                <td data-label="Date ajout">
                                    <time datetime="{{ $product->created_at->toDateString() }}">
                                        {{ $product->created_at->format('d/m/Y') }}
                                    </time>
                                </td>
                                <td data-label="Actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action btn-view" aria-label="Voir le produit">👁️</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit" aria-label="Modifier le produit">✏️</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" aria-label="Supprimer le produit" onclick="return confirm('Êtes-vous sûr ?')">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">📭 Aucun produit récent</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </section>

        <aside class="dashboard-side">
            <div class="widget widget-orders">
                <h3>Commandes récentes</h3>
                <ul class="orders-list">
                    @forelse($recentOrders as $order)
                    <li>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-view">
                            Commande #{{ $order->id }} — {{ number_format($order->total,0,',',' ') }} FCFA
                        </a>
                        <span class="muted">· {{ $order->created_at->diffForHumans() }}</span>
                    </li>
                    @empty
                    <li class="empty-state">Aucune commande récente.</li>
                    @endforelse
                </ul>
            </div>

            <div class="widget widget-lowstock">
                <h3>Produits en faible stock</h3>
                <ul class="lowstock-list">
                    @forelse($items as $item)
                    <li>
                        <a href="{{ route('admin.products.show', $item->id) }}">
                            {{ Str::limit($item->produitCapillaire->nom ?? $item->mecheExtension->marque ?? 'Produit', 28) }}
                        </a>
                        <span class="stock-count">({{ $item->stock->sum('quantite') }} unités)</span>
                    </li>
                    @empty
                    <li class="empty-state">Aucun produit faible en stock</li>
                    @endforelse
                </ul>
            </div>

            <div class="widget widget-actions">
                <h3>Actions rapides</h3>
                <div class="quick-actions">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-secondary">Nouveau produit</a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Toutes les commandes</a>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Clients</a>
                </div>
            </div>
        </aside>
    </section>

</main>

@endsection