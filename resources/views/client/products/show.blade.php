@extends('layouts.app')

@section('content')
<div class="product-details-container max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <div class="dashboard-header">
        <div>
            <h1>Détails du produit</h1>
            <p class="subtitle">...</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('client.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    <!-- Titre du produit -->
    <h1 class="text-3xl font-bold mb-6">{{ $product->categorie === 'produit_capillaire' ? $product->produitCapillaire->nom : $product->mecheExtension->style }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Image / Visuel -->
        <div class="product-image flex justify-center items-center">
            <img src="{{ asset('img/intro.png') }}" alt="intro" class="rounded-lg w-full max-w-md object-cover shadow-md">
        </div>

        <!-- Informations du produit -->
        <div class="product-info flex flex-col justify-between">
            <div>
                <p class="text-gray-700 mb-2"><strong>Catégorie :</strong> {{ ucfirst(str_replace('_', ' ', $product->categorie)) }}</p>
                <p class="text-gray-700 mb-2"><strong>Poids :</strong> {{ $product->poids ?? 'N/A' }} g</p>
                <p class="text-gray-700 mb-2"><strong>Prix :</strong> {{ number_format($product->prix_unitaire,0,',',' ') }} FCFA</p>
                <p class="text-gray-700 mb-4"><strong>Stock :</strong> {{ $product->stock->sum('quantite') ?? 0 }}</p>

                @if($product->mecheExtension)
                <h2 class="text-xl font-semibold mt-4 mb-2">Infos Mèche Extension</h2>
                <ul class="list-disc ml-6 text-gray-600">
                    <li>Nature : {{ $product->mecheExtension->nature }}</li>
                    <li>Marque : {{ $product->mecheExtension->marque }}</li>
                    <li>Style : {{ $product->mecheExtension->style }}</li>
                    <li>Style : {{ $product->mecheExtension->techniquePose->nom }}</li>
                </ul>
                @endif

                @if($product->produitCapillaire)
                <h2 class="text-xl font-semibold mt-4 mb-2">Infos Produit Capillaire</h2>
                <ul class="list-disc ml-6 text-gray-600">
                    <li>Nom : {{ $product->produitCapillaire->nom }}</li>
                    <li>Effet : {{ $product->produitCapillaire->effet->nom }}</li>
                    <li>Nature : {{ $product->produitCapillaire->natureAction->nom }}</li>
                </ul>
                @endif
            </div>

            <!-- Actions -->
            <div class="mt-6">
                <form action="{{ route('client.cart.add', $product->id) }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <button type="submit" class="btn btn-add">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection