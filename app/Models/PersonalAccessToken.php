<?php

namespace App\Models;


use Laravel\Sanctum\PersonalAccessToken as Model;

class PersonalAccessToken extends Model
{

    protected $casts = [
        'abilities' => 'json',
        'last_used_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'token',
        'abilities',
        'expires_at'
    ];
}
