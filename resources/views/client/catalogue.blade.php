@extends('layouts.auth-client.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Catalogue</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    @foreach($products as $product)
    <div class="bg-white shadow rounded-lg p-4">
        <p class="text-gray-700 font-semibold capitalize">{{ $product->categorie }}</p>
        <p class="text-xl font-bold text-blue-600">{{ $product->prix_unitaire }} F CFA</p>

        <a href="{{ route('client.product.show', $product) }}"
            class="block mt-3 text-sm text-blue-500 hover:underline">Voir détails</a>
    </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection