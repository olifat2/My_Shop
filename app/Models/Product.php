<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['categorie', 'poids', 'prix_unitaire'];

    public function mecheExtension() {
        return $this->hasOne(Meche_Extension::class, 'product_id');
    }

    public function produitCapillaire()
    {
        return $this->hasOne(Produit_Capillaire::class, 'product_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function commandeItems()
    {
        return $this->hasMany(CommandeItem::class);
    }
}
