@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Mon compte</h1>

<div class="bg-white shadow rounded-lg p-6">
    <p><strong>Nom :</strong> {{ $user->firstname }}</p>
    <p><strong>Prénom :</strong> {{ $user->lastname }}</p>
    <p><strong>Email :</strong> {{ $user->email }}</p>

    <div class="commandes">
        <p class="mt-6 text-gray-600 italic">Historique des commandes (à venir)</p>
        <a href="{{ route('client.orders.index') }}" class="btn btn-primary" aria-label="Voir toutes les commandes">Voir toutes les commandes</a>
    </div>
</div>
@endsection