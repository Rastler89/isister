<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specie extends Model
{

    use Translatable, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function breeds() {
        return $this->hasMany(Breed::class);
    }

    public function diseases() {
        return $this->belongsToMany(Disease::class);
    }

}
