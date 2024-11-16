<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','country_id','state_id',
    ];

    protected $casts = [
        'name' => 'json'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($town) {
            if (!$town->country_id) {
                $state = State::find($town->state_id); // Obtén el State relacionado
                $town->country_id = $state?->country_id; // Asigna el country_id del State
            }
        });
    }
}
