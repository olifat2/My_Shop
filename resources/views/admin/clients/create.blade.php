@extends('layouts.auth-admin.app')

@section('content')
<div>

    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Ajouter un client</h1>
            <p class="subtitle">Remplissez les informations pour créer un nouveau client</p>
        </div>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                Retour
            </a>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="auth-container client-create">
        <div class="card">
            <form action="{{ route('admin.clients.store') }}" method="POST" class="auth-form">
                @csrf
                <div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" placeholder="Jean" required autofocus
                            class="form-control @error('firstname') is-invalid @enderror">
                        @error('firstname')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" placeholder="Dupont" required autofocus
                            class="form-control @error('lastname') is-invalid @enderror">
                        @error('lastname')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="votre.email@exemple.com" required
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required
                            class="form-control @error('password') is-invalid @enderror">
                        <small class="password-hint">Au moins 8 caractères</small>
                        @error('password')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Bouton submit -->
                <button type="submit" class="btn btn-primary btn-block">Créer le client</button>
            </form>
        </div>
    </div>
</div>
@endsection