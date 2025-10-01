<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasteMaster extends Model
{
    use HasFactory;

    protected $table = 'caste_master';

    protected $fillable = [
        'title',
        'status',
    ];
}