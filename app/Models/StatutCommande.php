<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatutCommande extends Model
{
    protected $table = 'statut_commandes';
    protected $fillable = ['nom'];

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'statut_id');
    }
}
