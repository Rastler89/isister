<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property integer $user_id
 * @property string $type
 * @property string $stripe_id
 * @property string $stripe_price
 * @property integer $quantity
 * @property Carbon|string $trial_ends_at
 * @property Carbon|string $ends_at
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property boolean $active
 */
class Subscription extends Model
{
    use HasFactory;
}
