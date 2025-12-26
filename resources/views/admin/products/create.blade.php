@extends('layouts.auth-admin.app')

@section('content')
<div class="admin-container">
    <div class="dashboard-header">
        <div>
            <h1>Créer un produit</h1>
            <p class="subtitle">Ici vous pouvez ajouter vos produits et les enregistrer !</p>
        </div>
        <div class="header-actions-dash">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Retour</a>
        </div>
    </div>

    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="form-product-container">
        <form action="{{ route('admin.products.store') }}" method="POST" class="form-product">
            @csrf

            <!-- Choix de la catégorie -->
            <div class="item-product">
                <label for="categorie">Catégorie du produit :</label>
                <select class="category-select" name="categorie" id="categorie" required>
                    <option value="">-- Sélectionnez une catégorie --</option>
                    <option value="meche_extension">MÈCHES / EXTENSION</option>
                    <option value="produit_capillaire">PRODUITS CAPILLAIRES</option>
                </select>
            </div>

            <div class="champsContainer">
                <!-- Champs communs -->
                <div class="champsCommuns">
                    <h3>Détails du produit</h3>
                    <div class="item-product">
                        <label for="poids">Poids (g) :</label>
                        <input type="number" name="poids" id="poids" step="0.01" required>
                    </div>

                    <div class="item-product">
                        <label for="prix_unitaire">Prix unitaire (FCFA) :</label>
                        <input type="number" name="prix_unitaire" id="prix_unitaire" required>
                    </div>

                    <div class="item-product">
                        <label for="quantite">Quantité en stock :</label>
                        <input type="number" name="quantite" id="quantite" min="0" required>
                    </div>
                </div>

                <!-- Champs spécifiques : mèches -->
                <div id="meches-fields" class="categorie-fields" style="display: none;">
                    <h3>Détails des mèches / extensions</h3>
                    <div class="item-product">
                        <label for="marque">Marque :</label>
                        <input type="text" name="marque" id="marque">
                    </div>
                    <div class="item-product">
                        <label for="nature">Nature :</label>
                        <select name="nature" id="nature">
                            <option value="">-- Sélectionnez une nature --</option>
                            <option value="synthetique">Synthétique</option>
                            <option value="naturelle">Naturelle</option>
                        </select>
                    </div>
                    <div class="item-product">
                        <label for="style">Style :</label>
                        <input type="text" name="style" id="style">
                    </div>
                    <div class="item-product">
                        <label for="height">Hauteur (cm) :</label>
                        <input type="number" name="height" id="height" step="0.01">
                    </div>
                    <div class="item-product">
                        <label for="pcs">PCS :</label>
                        <input type="text" name="pcs" id="pcs">
                    </div>
                    <div class="item-product">
                        <label for="technique_pose_id">Technique de pose :</label>
                        <select name="technique_pose_id" id="technique_pose_id">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($techniques as $tech)
                            <option class="technique-product" value="{{ $tech->id }}">{{ $tech->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Champs spécifiques : produits capillaires -->
                <div id="capillaires-fields" class="categorie-fields" style="display: none;">
                    <h3>Détails du produit capillaire</h3>
                    <div class="item-product">
                        <label for="nom">Nom du produit :</label>
                        <input type="text" name="nom" id="nom">
                    </div>
                    <div class="item-product">
                        <label for="volume">Volume (ml) :</label>
                        <input type="number" name="volume" id="volume" step="0.01">
                    </div>
                    <div class="item-product">
                        <label for="effet_id">Effet :</label>
                        <select name="effet_id" id="effet_id">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($effets as $effet)
                            <option value="{{ $effet->id }}">{{ $effet->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="item-product">
                        <label for="nature_action_id">Nature d’action :</label>
                        <select name="nature_action_id" id="nature_action_id">
                            <option value="">-- Sélectionnez --</option>
                            @foreach($natures as $nature)
                            <option value="{{ $nature->id }}">{{ $nature->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <div class="form-product-container">
        <form action="{{ route('admin.technique.save.store') }}" method="POST" class="form-product technique_pose-create">
            @csrf

            <!-- Choix de la technique -->
            <div class="item-product">
                <label for="nom">Technique de pose de vos mèches :</label>
                <input type="text" name="nom" id="nomTechniquePose">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <div class="form-product-container">
        <form action="{{ route('admin.nature.save.store') }}" method="POST" class="form-product nature-create">
            @csrf

            <!-- Choix de la nature des produits -->
            <div class="item-product">
                <label for="nom">Nature d'action de vos produits :</label>
                <input type="text" name="nom" id="nomNatureAction">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <div class="form-product-container">
        <form action="{{ route('admin.effet.save.store') }}" method="POST" class="form-product effet-create">
            @csrf

            <!-- Choix de l'effet des produits -->
            <div class="item-product">
                <label for="nom">Effet de vos produits :</label>
                <input type="text" name="nom" id="nomEffetProduit">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('categorie').addEventListener('change', function() {
        let value = this.value;
        document.getElementById('meches-fields').style.display = value === 'meche_extension' ? 'block' : 'none';
        document.getElementById('capillaires-fields').style.display = value === 'produit_capillaire' ? 'block' : 'none';
    });
</script>
@endsection
