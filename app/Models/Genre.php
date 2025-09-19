<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Song;
class Genre extends Model
{
    use HasFactory;
    // public function songs()
    // {
    //     return $this->hasMany(\App\Models\Song::class);
    // }
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

}



