<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Blog extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'text', 'image', 'user_id'
    ];

    function getUserLogin(): string
    {

        return User::find($this->user_id)->login;
    }
}