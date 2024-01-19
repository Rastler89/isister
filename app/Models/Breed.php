<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Breed extends Model
{
    use Translatable;

    protected $fillable = ['name'];

    public function species() {
        return $this->belongsTo(Species::class);
    }
}
