@extends('layouts.auth-admin.app')

@section('content')
<div>

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Modifier le client</h1>
            <p class="subtitle">Mettez à jour les informations du client</p>
        </div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="auth-container client-edit">
        <div class="card">
            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" class="auth-form">
                @csrf
                @method('PUT')
                <div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $client->firstname) }}" required autofocus
                            class="form-control @error('firstname') is-invalid @enderror">
                        @error('firstname')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $client->lastname) }}" required autofocus
                            class="form-control @error('lastname') is-invalid @enderror">
                        @error('lastname')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" required autofocus
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- Bouton submit -->
                <button type="submit" class="btn btn-primary btn-block">Mettre à jour</button>
        </div>
    </div>

</div>
@endsection
