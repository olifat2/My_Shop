<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit_Capillaire extends Model
{
    protected $table = 'produit_capillaires';

    protected $fillable = ['product_id', 'nom', 'effet_id', 'nature_action_id', 'volume'];
    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function effet()
    {
        return $this->belongsTo(Effets::class, 'effet_id');
    }

    public function natureAction()
    {
        return $this->belongsTo(Nature_Actions::class, 'nature_action_id');
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtoupper($value);
    }
}
