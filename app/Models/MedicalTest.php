<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Added import

class MedicalTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'description',
        'created_at'
    ];

    // Renamed from MedicalType to medicalType for convention
    // Callers of this method might need to be updated.
    public function medicalType(): BelongsTo { 
        return $this->belongsTo(MedicalType::class, 'type'); // Assuming 'type' is the foreign key
    }
}
