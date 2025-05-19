<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'id', 'name', 'date'
    ];



    public $timestamps = false;


    
    protected $casts = [
        'date' => 'date'
    ];
}
