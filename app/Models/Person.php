<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';

    protected $fillable = [
        'idusers','user','password','Name','Paternal','Maternal','Token','remember_token','created_at','updated_at',
    ];

    protected $hidden = [
        'remember_token',
    ];
}
