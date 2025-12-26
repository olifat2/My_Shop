<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MyShop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.header')

    <!-- Mini panier -->
    <div class="mini-cart" id="miniCart">
        <h3>Mon panier</h3>

        @php
        $cart = session('cart', []);
        $total = collect($cart)->sum('subtotal');
        @endphp

        <div class="mini-cart-items">
            @forelse($cart as $item)
            <div class="mini-cart-item" data-id="{{ $item['id'] }}">
                <span class="item-name">{{ $item['name'] }}</span>
                <span class="item-qty">x{{ $item['qty'] }}</span>
                <span class="item-subtotal">{{ number_format($item['subtotal'],0,',',' ') }} FCFA</span>
            </div>
            @empty
            <p>Votre panier est vide</p>
            @endforelse
        </div>

        @if(count($cart) > 0)
        <div class="mini-cart-total">
            <strong>Total :</strong> <span>{{ number_format($total,0,',',' ') }} FCFA</span>
        </div>
        <a href="{{ route('client.cart') }}" class="btn btn-primary btn-checkout">Voir le panier / Commander →</a>
        @endif
    </div>

    <main class="main">
        @yield('content')
    </main>
</body>

</html>
