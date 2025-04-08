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
        'description',
        'type',
        'category',
        'symptoms',
        'cont_animal',
        'cont_human',
        'transmision',
        'forecast',
        'prevention',
        'go'

    ];

    protected $casts = [
        'name' => 'json',
        'description' => 'json',
        'symptoms' => 'json',
        'transmision' => 'json',
        'forecast' => 'json',
        'prevention' => 'json',
        'go' => 'json'
    ];

    public function species() {
        return $this->belongsToMany(Specie::class);
    }
}
