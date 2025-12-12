@extends('layouts.auth-admin.app')

@section('title', 'Modifier le produit')

@section('content')
<div class="container-edit">
    <div class="card-edit">
        <h2 class="edit-title">Modifier le produit</h2>

        <div class="divider"></div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="poids">Poids (g)</label>
                <input type="number" id="poids" name="poids" value="{{ old('poids', $product->poids) }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="prix_unitaire">Prix unitaire (F CFA)</label>
                <input type="number" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire', $product->prix_unitaire) }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="quantite">Quantité en stock</label>
                <input type="number" id="quantite" name="quantite" value="{{ old('quantite', $product->stock->sum('quantite') ?? 0) }}" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Enregistrer</button>
                <a href="{{ route('admin.products.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection