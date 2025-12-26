<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandeItem extends Model
{
    protected $table = 'commande_items';
    protected $fillable = ['commande_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
