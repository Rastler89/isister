<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Constant extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'value',
        'created_at'
    ];
}
