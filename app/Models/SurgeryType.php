<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'operation_types';

    public function surgeries() {
        return $this->hasMany(Surgery::class);
    }
}
