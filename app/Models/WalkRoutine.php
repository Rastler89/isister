<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalkRoutine extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'dayOfWeek',
        'time',
        'intensity',
        'route',
        'duration'
    ];
}
