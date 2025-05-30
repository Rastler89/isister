<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Town[] $towns
 */
class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','country_id'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function towns() {
        return $this->hasMany(Town::class);
    }
}
