<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = 'commandes';
    protected $fillable = ['client_id', 'statut_id', 'total'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function statut()
    {
        return $this->belongsTo(StatutCommande::class, 'statut_id');
    }

    public function items()
    {
        return $this->hasMany(CommandeItem::class);
    }
}
