<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'preop',
        'description',
        'result',
        'complications'
    ];

    public function surgeryType() {
        return $this->belongsTo(SurgeryType::class);
    }
}
