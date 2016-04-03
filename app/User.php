<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Get User role
    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    // Check if user has a role
    public function has_role($name)
    {
        if ($this->role->name == $name) return true;

        return false;
    }
}
