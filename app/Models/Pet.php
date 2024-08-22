<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function visits(): HasMany {
        return $this->hasMany(VetVisit::class);
    }

    public function surgeries(): HasMany {
        return $this->hasMany(Surgery::class);
    }

    public function treatments(): HasMany {
        return $this->hasMany(Treatment::class);
    }

    public function vaccines(): HasMany {
        return $this->hasMany(Vaccine::class);
    }

    public function allergies():HasMany {
        return $this->hasMany(Allergy::class);
    }

    public function diets(): HasMany {
        return $this->hasMany(Diet::class);
    }

    public function walks(): HasMany {
        return $this->hasMany(WalkRoutine::class);
    }

    public function breed(): HasMany {
        return $this->hasMany(Breed::class);
    }
}
