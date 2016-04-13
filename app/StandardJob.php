<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardJob extends Model
{
    protected $fillable = ['name', 'price', 'acronym', 'duration'];
}
