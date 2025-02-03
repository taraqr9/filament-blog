<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    protected $casts = [
        'permissions' => 'array',
    ];
}
