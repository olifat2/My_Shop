<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'imgProfil',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    // Relations avec les modèles étendus
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    // Relation vers les commandes (via Client)
    public function commandes()
    {
        return $this->hasManyThrough(
            Commande::class,
            Client::class,
            'user_id',   // clé étrangère dans clients
            'client_id', // clé étrangère dans commandes
            'id',        // clé locale dans users
            'id'         // clé locale dans clients
        );
    }

    // Exemple : favoris
    // public function favoris()
    // {
    //     return $this->hasMany(Favori::class);
    // }
}
