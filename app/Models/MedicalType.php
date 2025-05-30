<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stripe\Collection;

/**
 * @property array<string> $name
 * @property Collection|MedicalTest[] $medicals
 */
class MedicalType extends Model
{
    use HasFactory;

    protected $table = 'test_types';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function medicals(): HasMany {
        return $this->hasMany(MedicalTest::class);
    }
}
