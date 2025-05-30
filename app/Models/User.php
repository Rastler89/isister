<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property Subscription|null $subscription
 * @property Collection|Pet[] $pets
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable, SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }

    public function pets() {
        return $this->hasMany(Pet::class);
    }
}
