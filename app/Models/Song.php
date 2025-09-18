<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'artist', 'duration', 'genre_id'];


    public function genre()
    {
        return $this->belongsTo(\App\Models\Genre::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(\App\Models\Playlist::class);
    }

}
