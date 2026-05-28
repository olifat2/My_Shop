<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Effets extends Model
{
    protected $table = 'effets';

    protected $fillable = ['nom'];

    public function produitCapillaire()
    {
        return $this->hasMany(Produit_Capillaire::class, 'effet_id');
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtoupper($value);
    }
}
