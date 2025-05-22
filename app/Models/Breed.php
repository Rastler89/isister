<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breed extends Model
{
    use Translatable, SoftDeletes, HasFactory;

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
