<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function states() {
        return $this->hasMany(State::class);
    }

    public function towns() {
        return $this->hasMany(Town::class);
    }
}
