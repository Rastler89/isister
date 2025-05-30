<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specie;

/**
 * @property Collection|Specie[] $species
 * @property string $slug
 * @property array<string> $name
 * @property string $description
 * @property string $type
 * @property string $category
 * @property string $symptoms
 * @property boolean $cont_animal
 * @property boolean $cont_human
 * @property string $forecast
 * @property string $prevention
 * @property string $go
 */
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
