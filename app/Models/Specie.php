<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Specie extends Model
{

    use Translatable, SoftDeletes;

    protected $fillable = ['name'];

    public function breeds() {
        return $this->hasMany(Breed::class);
    }

    public function diseases() {
        return $this->belongsToMany(Disease::class);
    }

}
