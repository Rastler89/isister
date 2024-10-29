<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryType extends Model
{
    use HasFactory;

    protected $table = 'operation_types';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'json'
    ];

    public function surgeries() {
        return $this->hasMany(Surgery::class);
    }
}
