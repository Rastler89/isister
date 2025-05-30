<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property Carbon|string $dayOfWeek
 * @property Carbon|string $time
 * @property integer $intensity
 * @property string $description
 * @property integer $duration
 * @property string $route
 */
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
