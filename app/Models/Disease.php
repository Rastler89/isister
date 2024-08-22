<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    public function species(): BelongsToMany {
        return $this->belongsToMany(Specie::class, 'species_diseases', 'disease_id','specie_id');
    }
}
