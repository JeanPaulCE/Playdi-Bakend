<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Sanctum\PersonalAccessToken;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function createToken(string $name, $expiresAt = null, array $abilities = ['*'])
    {
        if ($expiresAt == null) {
            $expiresAt = now()->addMinutes(2);
        }
        $token = $this->tokens()->create([
            'name' => $name . "v",
            'expires_at' => now()->addDays(22),
            //'expires_at' => now()->addDays(12),
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,

        ]);

        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }
}
