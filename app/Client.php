<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'title_id',
        'name',
        'surname',
        'spouse_name',
        'phone',
        'work',
        'mobile',
        'email',
        'fax',
        'type'
    ];
}
