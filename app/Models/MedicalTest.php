<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'description',
        'created_at'
    ];

    public function MedicalType(): BelongsTo {
        return $this->belongsTo(MedicalType::class);
    }
}
