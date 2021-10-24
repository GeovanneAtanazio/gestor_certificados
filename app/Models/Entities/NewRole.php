<?php

namespace App\Models\Entities;

use Spatie\Permission\Models\Role;

class NewRole extends Role
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'guard_name',
        'pivot',
        'created_at', 
        'updated_at',
     ];
    
}