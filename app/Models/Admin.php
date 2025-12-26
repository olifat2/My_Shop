<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable = [
        'user_id',
        // Ajouter d'autres infos spécifiques à l'admin si nécessaire
    ];

    // Relation vers User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Actions administratives
    public function gererUtilisateurs()
    {
        // Logique spécifique à implémenter
    }

    public function superviserPaiements()
    {
        // Logique spécifique à implémenter
    }

    public function intervenirSurCommande()
    {
        // Logique spécifique à implémenter
    }
}
