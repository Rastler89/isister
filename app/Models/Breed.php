<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Breed extends Model
{
    use Translatable, SoftDeletes;

    protected $fillable = ['name'];

    public function species(): BelgonsTo {
        return $this->belongsTo(Species::class);
    }
}
