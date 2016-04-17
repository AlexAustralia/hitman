<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardJobTask extends Model
{
    protected $fillable = ['name', 'standard_job_id'];
}
