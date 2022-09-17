<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Auth extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'session',
        'user_id'
    ];

}