<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = [
        'idmovies','Title','Director','Country','Qualification','Year','created_at','updated_at','id_users','id_genre_movie',
    ];
}
