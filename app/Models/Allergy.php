<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $description
 * @property integer $severity
 */
class Allergy extends Model
{
    use HasFactory;

    public string $name;
    public ?string $description = null;
    public ?string $severity = null;

    protected $fillable = [
        'name',
        'description',
        'severity'
    ];
}
