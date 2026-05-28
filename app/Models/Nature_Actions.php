<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nature_Actions extends Model
{
    protected $table = 'nature_actions';

    protected $fillable = ['nom'];

    public function produitCapillaire()
    {
        return $this->hasMany(Produit_Capillaire::class, 'nature_action_id');
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtoupper($value);
    }
}
