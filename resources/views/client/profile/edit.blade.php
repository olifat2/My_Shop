@extends('layouts.app')

@section('content')
<div class="edit-container">

    <!-- Messages de succès -->
    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    <!-- Carte formulaire -->
    <div class="card">
        <!-- En-tête -->
        <div class="dashboard-header">
            <div>
                <h1>Modifier mon profil</h1>
                <p class="substitle">
                    Mettez à jour vos informations personnelles
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('client.profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="form-group">
                <label for="firstname">
                    Nom
                </label>
                <input
                    type="text"
                    id="firstname"
                    name="firstname"
                    value="{{ old('firstname', $user->firstname) }}"
                    required>
                @error('firstname')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div class="form-group">
                <label for="lastname">
                    Prénom
                </label>
                <input
                    type="text"
                    id="lastname"
                    name="lastname"
                    value="{{ old('lastname', $user->lastname) }}"
                    required>
                @error('lastname')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">
                    Adresse email
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    required>
                @error('email')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="form-actions">

                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    Annuler
                </a>

                <button
                    type="submit" class="btn btn-primary">
                    Enregistrer
                </button>

            </div>
        </form>

    </div>

</div>
@endsection