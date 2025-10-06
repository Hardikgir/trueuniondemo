<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'highest_education_id',
        'education_id',
        'employed_in',
        'occupation_id',
        'annual_income',
        'country_id',
        'state_id',
        'city_id',
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
}