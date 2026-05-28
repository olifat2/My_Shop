@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="card">
        <!-- Header -->
        <div class="auth-header">
            <h1>Créer un compte</h1>
            <p>Rejoignez MyShop et profitez de nos services</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Erreur lors de l'inscription</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
        @endif

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <!-- First Name Field -->
            <div class="form-group">
                <label for="firstname">Prénom</label>
                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    value="{{ old('firstname') }}"
                    placeholder="Jean"
                    required
                    autofocus
                    class="form-control @error('firstname') is-invalid @enderror">
                @error('firstname')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name Field -->
            <div class="form-group">
                <label for="lastname">Nom</label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    value="{{ old('lastname') }}"
                    placeholder="Dupont"
                    required
                    class="form-control @error('lastname') is-invalid @enderror">
                @error('lastname')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="votre.email@exemple.com"
                    required
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    class="form-control @error('password') is-invalid @enderror">
                <small class="password-hint">Au moins 8 caractères</small>
                @error('password')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Confirmation Field -->
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="••••••••"
                    required
                    class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Terms & Conditions Checkbox -->
            <div class="form-check">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    required
                    class="form-check-input">
                <label for="terms" class="form-check-label">
                    J'accepte les <a href="#" class="link-secondary">conditions d'utilisation</a> et la <a href="#" class="link-secondary">politique de confidentialité</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">
                Créer mon compte
            </button>
        </form>

        <!-- Divider -->
        <div class="auth-divider">
            <span>ou</span>
        </div>

        <!-- Already have account -->
        <div class="auth-center-link">
            <p> Vous avez déjà un compte ?</p>
            <a href="{{ route('login.form') }}" class="auth-link-primary">
                Se connecter
            </a>
        </div>

        <!-- Back to Home -->
        <div class="auth-footer">
            <a href="{{ route('accueil') }}" class="auth-link-back">
                ← Retour à l'accueil
            </a>
        </div>
    </div>
</div>
@endsection

