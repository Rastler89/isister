<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection|Disease[] $disease
 */
class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'disease',
        'lot',
        'application',
        'next'
    ];
    public function disease() {
        return $this->hasMany(Disease::class);
    }
}
