<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meche_Extension extends Model
{
    protected $table = 'meche_extensions';

    protected $fillable = ['product_id', 'nature', 'marque', 'style', 'technique_pose_id', 'pcs', 'height'];
    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function techniquePose()
    {
        return $this->belongsTo(Technique_Pose::class, 'technique_pose_id');
    }

    public function setMarqueAttribute($value)
    {
        $this->attributes['marque'] = strtoupper($value);
    }

    public function setStyleAttribute($value)
    {
        $this->attributes['style'] = strtoupper($value);
    }

    public function setPcsAttribute($value)
    {
        $this->attributes['pcs'] = strtoupper($value);
    }

    public function setNatureAttribute($value)
    {
        $this->attributes['nature'] = strtoupper($value);
    }
}
