<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NeighbouringSuburb extends Model
{
    protected $fillable = ['suburb_id', 'neighbour_suburb_id'];
}
