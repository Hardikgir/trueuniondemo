<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            // Assign free plan to newly created users
            $membershipService = app(\App\Services\MembershipService::class);
            $membershipService->assignFreePlan($user);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'profile_image',
        'gender',
        'height',
        'weight',
        'dob',
        'birth_time',
        'birth_place',
        'raashi',
        'caste',
        'nakshtra',
        'naadi',
        'marital_status',
        'mother_tongue',
        'physically_handicap',
        'diet',
        'languages_known',
        'highest_education', // VARCHAR field, not foreign key
        'education_details', // VARCHAR field, not foreign key
        'employed_in',
        'occupation', // VARCHAR field, not foreign key
        'annual_income',
        'country', // VARCHAR field, not foreign key
        'state', // VARCHAR field, not foreign key
        'city', // VARCHAR field, not foreign key
        'mobile_number',
        'google_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Retrieve the model for bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        // Try to decrypt the value first
        try {
            $decrypted = decrypt($value);
            return $this->where($field ?? $this->getRouteKeyName(), $decrypted)->first();
        } catch (\Exception $e) {
            // If decryption fails, try as plain ID (for backward compatibility)
            return $this->where($field ?? $this->getRouteKeyName(), $value)->first();
        }
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveChildRouteBinding($childType, $value, $field)
    {
        try {
            $decrypted = decrypt($value);
            return parent::resolveChildRouteBinding($childType, $decrypted, $field);
        } catch (\Exception $e) {
            return parent::resolveChildRouteBinding($childType, $value, $field);
        }
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return encrypt($this->getAttribute($this->getRouteKeyName()));
    }

    /**
     * Get the user's memberships.
     */
    public function memberships(): BelongsToMany
    {
        return $this->belongsToMany(Membership::class, 'user_memberships')
            ->withPivot('visits_used', 'is_active', 'purchased_at', 'expires_at')
            ->withTimestamps();
    }

    /**
     * Get the user's active membership.
     */
    public function activeMembership()
    {
        return $this->belongsToMany(Membership::class, 'user_memberships')
            ->wherePivot('is_active', 1)
            ->withPivot('visits_used', 'is_active', 'purchased_at', 'expires_at')
            ->withTimestamps()
            ->first();
    }
}