<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    protected $fillable = [
        'name', 'description', 'image', 'url'
    ];

}
