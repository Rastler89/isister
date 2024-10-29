<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Breed extends Model
{
    use Translatable, SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function species() {
        return $this->belongsTo(Specie::class);
    }
}
