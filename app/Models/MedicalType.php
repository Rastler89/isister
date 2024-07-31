<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalType extends Model
{
    use HasFactory;

    protected $table = 'test_types';

    public function medicals() {
        return $this->hasMany(Medical::class);
    }
}
