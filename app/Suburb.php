<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    protected $fillable = ['locality', 'postcode'];
}
