<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Specie extends Model
{

    use Translatable;

    protected $fillable = ['name'];

    public function breeds() {
        return $this->hasMany(Breed::class);
    }

    public function diseases() {
        return $this->belongsToMany(Disease::class);
    }

}
