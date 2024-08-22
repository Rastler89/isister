<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    use HasFactory;

    public function MedicalType(): BelongsTo {
        return $this->belongsTo(MedicalType::class);
    }
}
