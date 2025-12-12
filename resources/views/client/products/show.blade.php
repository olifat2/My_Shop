@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-4">Détails du produit</h1>

    <p class="text-gray-700 mb-2"><strong>Catégorie:</strong> {{ $product->categorie }}</p>
    <p class="text-gray-700 mb-2"><strong>Poids:</strong> {{ $product->poids }} g</p>
    <p class="text-gray-700 mb-2"><strong>Prix:</strong> {{ $product->prix_unitaire }} F CFA</p>

    @if($product->meche_extension)
    <h2 class="text-xl font-semibold mt-4 mb-2">Infos Mèche Extension</h2>
    <ul class="list-disc ml-6 text-gray-600">
        <li>Nature : {{ $product->meche_extension->nature }}</li>
        <li>Marque : {{ $product->meche_extension->marque }}</li>
        <li>Style : {{ $product->meche_extension->style }}</li>
    </ul>
    @endif

    @if($product->produit_capillaire)
    <h2 class="text-xl font-semibold mt-4 mb-2">Infos Produit Capillaire</h2>
    <ul class="list-disc ml-6 text-gray-600">
        <li>Nom : {{ $product->produit_capillaire->nom }}</li>
        <li>Contenance : {{ $product->produit_capillaire->contenance }}</li>
    </ul>
    @endif
    
    <button class="mt-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Ajouter au panier
    </button>

</div>
@endsection