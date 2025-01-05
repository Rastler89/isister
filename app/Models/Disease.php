<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'description'
    ];

    protected $casts = [
        'name' => 'json',
        'description' => 'json'
    ];

    public function species() {
        return $this->belongsToMany(Specie::class);
    }
}
