<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NakshatraMaster extends Model
{
    use HasFactory;

    protected $table = 'nakshatra_master';

    protected $fillable = [
        'name',
        'status',
    ];
}
