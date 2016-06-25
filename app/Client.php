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

    /**
     * Get Client's property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getProperty()
    {
        return $this->hasMany('\App\Property');
    }
}
