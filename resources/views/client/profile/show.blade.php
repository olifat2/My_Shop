@extends('layouts.app')

@section('content')
<div>

    <!-- En-tête -->
    <div class="mb-8">
        <h1>Mon compte</h1>
        <p>
            Consultez et gérez vos informations personnelles
        </p>
    </div>

    <!-- Carte informations personnelles -->
    <div>
        <h2>
            Informations personnelles
        </h2>

        <div>
            <div>
                <p>Nom</p>
                <p>{{ $user->firstname }}</p>
            </div>

            <div>
                <p>Prénom</p>
                <p>{{ $user->lastname }}</p>
            </div>

            <div>
                <p>Adresse email</p>
                <p>{{ $user->email }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6">
            <a href="{{ route('client.profile.edit') }}">
                Modifier mes informations
            </a>
        </div>
    </div>

    <!-- Carte commandes -->
    <div>
        <h2>
            Mes commandes
        </h2>

        <p>
            Consultez l’historique et le statut de vos commandes.
        </p>

        <a href="{{ route('client.orders.index') }}" class="btn btn-primary" aria-label="Voir toutes mes commandes">
            Voir toutes mes commandes
        </a>
    </div>

</div>
@endsection