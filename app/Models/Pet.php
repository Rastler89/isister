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

    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vetvisits(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(VetVisit::class);
    }

    public function surgeries(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Surgery::class);
    }

    public function treatments(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Treatment::class);
    }

    public function vaccines(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Vaccine::class);
    }

    public function allergies(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Allergy::class);
    }

    public function diets(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Diet::class);
    }

    public function walkroutines(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(WalkRoutine::class);
    }

    public function breed(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Breed::class);
    }

    public function medicaltests(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(MedicalTest::class);
    }

    public function constants(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Constant::class);
    }
}
