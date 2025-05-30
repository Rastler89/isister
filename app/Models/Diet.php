<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $description
 * @property integer $dayOfWeek
 * @property Carbon|string $time
 * @property integer $type
 * @property string $amount
 * @property string $brand
 * @property string $information
 */
class Diet extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'dayOfWeek',
        'time',
        'type',
        'amount',
        'brand',
        'information'
    ];
}
