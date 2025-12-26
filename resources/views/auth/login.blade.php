@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="card">
        <!-- Header -->
        <div class="auth-header">
            <h1>Se connecter</h1>
            <p>Accédez à votre compte MyShop</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>⚠️ Erreur de connexion</strong>
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

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

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
                    autofocus
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
                @error('password')
                <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-check">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="form-check-input">
                <label for="remember" class="form-check-label">
                    Me rester connecté
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">
                Se connecter
            </button>
        </form>

        <!-- Divider -->
        <div class="auth-divider">
            <span>ou</span>
        </div>

        <!-- Links Section -->
        <div class="auth-links">
            <div class="auth-link-item">
                <a href="#" class="auth-link-secondary">
                    🔑 Mot de passe oublié ?
                </a>
            </div>
            <div class="auth-link-item">
                <a href="{{ route('register.form') }}" class="auth-link-primary">
                    📝 Créer un compte
                </a>
            </div>
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

