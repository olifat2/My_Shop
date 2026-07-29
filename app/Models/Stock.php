<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';

    protected $fillable = ['product_id', 'quantite'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class, 'product_id', 'product_id');
    }
}
