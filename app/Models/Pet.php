<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function visits() {
        return $this->hasMany(VetVisit::class);
    }

    public function surgeries() {
        return $this->hasMany(Surgery::class);
    }

    public function treatments() {
        return $this->hasMany(Treatment::class);
    }

    public function vaccines() {
        return $this->hasMany(Vaccine::class);
    }

    public function allergies() {
        return $this->hasMany(Allergy::class);
    }

    public function diets() {
        return $this->hasMany(Diet::class);
    }

    public function walks() {
        return $this->hasMany(WalkRoutine::class);
    }

    public function breed() {
        return $this->hasMany(Breed::class);
    }
}
