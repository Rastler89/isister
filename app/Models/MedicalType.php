<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Medical::class);
    }
}
