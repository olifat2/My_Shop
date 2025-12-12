@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Catalogue de produits</h1>

<div class="view-products">
    <div class="section-title">
        <h1 class="title">Nos produits pour cheveux et soins capillaires.</h1>
        <p class="description">
            Nous mettons à votre disposition des produits capillaires de qualité et disponibles pour tous types de cheveux.
            L'état de nos cheveux est un détail très important, encore plus pour vous les femmes. Il serait très frustrant d'arriver
            au terme d'un long travail et de patience pour ensuite être déçue du résultat de votre passage chez votre coiffeuse.
            Cela fait que le choix de ses produits sont très réfléchis et nous nous faisons un devoir de vous aider en proposant une
            qualité de produits très au desssus des normes et surtout nos produits sont durables avec des résultats très performants.
            En choisissant de vous offrir l'un de nos produits, vous prenez la décision de réaliser un achat plein de bénéfices parce que
            vous n'aurez aucun regret avec une satisfaction garantie.
        </p>
    </div>

    <div class="section-products">

        <div class="grid-text">
            <h2>
                Explorer notre catalogue de produits.
            </h2>
        </div>

        <div class="products-grid grid-view">
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
    </div>
</div>


@endsection