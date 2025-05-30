<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property integer $type
 * @property float $value
 * @property \Illuminate\Support\Carbon|string $created_at
 */
class Constant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'created_at'
    ];
}
