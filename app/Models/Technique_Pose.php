<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technique_Pose extends Model
{
    protected $table = 'technique_poses';

    protected $fillable = ['nom'];

    public function mecheExtension()
    {
        return $this->hasMany(Meche_Extension::class, 'technique_pose_id');
    }

    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtoupper($value);
    }
}
