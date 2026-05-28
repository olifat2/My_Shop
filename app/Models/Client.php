<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'user_id',
        // Ajouter d'autres infos spécifiques au client si besoin
    ];

    // Relation vers User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Commandes passées par le client
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
