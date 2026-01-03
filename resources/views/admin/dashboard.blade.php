@extends('layouts.auth-admin.app')

@section('title', 'Tableau de bord administrateur')

@section('content')
<div class="admin-container">
    <!-- Header avec titre et actions -->
    <div class="dashboard-header">
        <div>
            <h1>Tableau de Bord</h1>
            <p class="subtitle">Bienvenue ! Voici un aperçu de votre boutique</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">➕ Nouveau produit</a>
        </div>
    </div>

    <!-- Statistiques principales -->
    <div class="stats-grid">
        <!-- Total Produits -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon stat-icon-products">📦</span>
                <span class="stat-badge">+{{ rand(1, 5) }}%</span>
            </div>
            <div class="stat-body">
                <h3>Produits</h3>
                <p class="stat-value">{{ $totalProducts }}</p>
                <p class="stat-label">produits actifs</p>
            </div>
            <div class="stat-chart"></div>
        </div>

        <!-- Total Commandes -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon stat-icon-orders">📋</span>
                <span class="stat-badge">+{{ rand(2, 8) }}%</span>
            </div>
            <div class="stat-body">
                <h3>Commandes</h3>
                <p class="stat-value">{{ $totalOrders }}</p>
                <p class="stat-label">ce mois</p>
            </div>
            <div class="stat-chart"></div>
        </div>

        <!-- Total Clients -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon stat-icon-clients">👥</span>
                <span class="stat-badge">+{{ rand(3, 12) }}%</span>
            </div>
            <div class="stat-body">
                <h3>Clients</h3>
                <p class="stat-value">{{ $totalClients }}</p>
                <p class="stat-label">clients actifs</p>
            </div>
            <div class="stat-chart"></div>
        </div>

        <!-- Revenu Total -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-icon stat-icon-revenue">💰</span>
                <span class="stat-badge">+{{ rand(5, 15) }}%</span>
            </div>
            <div class="stat-body">
                <h3>Revenu</h3>
                <p class="stat-value">{{ number_format($orders->sum('total'),0,',',' ') }} FCFA</p>
                <p class="stat-label">ce mois</p>
            </div>
            <div class="stat-chart"></div>
        </div>
    </div>

    <div class="dashboard-layout">
        <div class="dashboard-main">
            <!-- Section Mèches Extensions -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Mèches & Extensions</h2>
                    <a href="{{ route('admin.products.index') }}" class="link-secondary">Voir tous →</a>
                </div>
                <div class="table-responsive">
                    <table class="table-product">
                        <thead>
                            <tr>
                                <th>Nature</th>
                                <th>Marque</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Date ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestProductsMeche as $product)
                            @php $qty = $product->stock->sum('quantite'); @endphp
                            <tr>
                                <td data-label="Nature"><span class="cell-label">{{ $product->mecheExtension->nature }}</span></td>
                                <td data-label="Marque"><span class="cell-brand">{{ ucfirst($product->mecheExtension->marque) }}</span></td>
                                <td data-label="Prix"><span class="cell-price">{{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA</span></td>
                                <td data-label="Stock">
                                    <span class="stock-badge {{ $qty > 10 ? 'stock-high' : ($qty > 0 ? 'stock-medium' : 'stock-low') }}">
                                        {{ $qty }} unités
                                    </span>
                                </td>
                                <td data-label="Date ajout"><small>{{ $product->created_at->format('d/m/Y') }}</small></td>
                                <td data-label="Actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action btn-view" title="Voir">👁️</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit" title="Modifier">✏️</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center empty-state">📭 Aucun produit récent</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Produits Capillaires -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h2>Produits Capillaires</h2>
                    <a href="{{ route('admin.products.index') }}" class="link-secondary">Voir tous →</a>
                </div>
                <div class="table-responsive">
                    <table class="table-product">
                        <thead>
                            <tr>
                                <th>Effet</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Date ajout</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestProductsCapillaire as $product)
                            <tr>
                                <td data-label="Effet"><span class="cell-label">{{ $product->produitCapillaire->effet->nom }}</span></td>
                                <td data-label="Nom"><span class="cell-brand">{{ ucfirst($product->produitCapillaire->nom) }}</span></td>
                                <td data-label="Prix"><span class="cell-price">{{ number_format($product->prix_unitaire, 0, ',', ' ') }} FCFA</span></td>
                                <td data-label="Stock">
                                    <span class="stock-badge {{ $product->stock->sum('quantite') > 10 ? 'stock-high' : ($product->stock->sum('quantite') > 0 ? 'stock-medium' : 'stock-low') }}">
                                        {{ $product->stock->sum('quantite') }} unités
                                    </span>
                                </td>
                                <td data-label="Date ajout"><small>{{ $product->created_at->format('d/m/Y') }}</small></td>
                                <td data-label="Actions">
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn-action btn-view" title="Voir">👁️</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action btn-edit" title="Modifier">✏️</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center empty-state">📭 Aucun produit récent</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
    </div>

</div>

@endsection
