<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'cat_genre_movie';

    protected $fillable = [
        'id_genre_movie','Genre','created_at','updated_at',
    ];
}
