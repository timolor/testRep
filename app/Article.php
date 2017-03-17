<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class Article extends Model
{

    /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'title',
        'message',
        'username',
    ];
}
