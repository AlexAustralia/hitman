<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * Get Client's record
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getClient()
    {
        return $this->belongsTo('\App\Client', 'client_id', 'id');
    }
}
