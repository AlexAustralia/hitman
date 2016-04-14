<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardTask extends Model
{
    protected $fillable = ['name', 'price'];
}
