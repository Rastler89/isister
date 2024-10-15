<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'birth',
        'code',
        'breed_id',
        'status',
        'image',
        'character',
        'description',
        'hash'
    ];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function vetvisits() {
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

    public function allergies(){
        return $this->hasMany(Allergy::class);
    }

    public function diets() {
        return $this->hasMany(Diet::class);
    }

    public function walkroutines() {
        return $this->hasMany(WalkRoutine::class);
    }

    public function breed() {
        return $this->hasMany(Breed::class);
    }

    public function medicaltests() {
        return $this->hasMany(MedicalTest::class);
    }
}
