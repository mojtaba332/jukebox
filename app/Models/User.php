<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
        protected $fillable = [
        'name',
        'username',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }



}
