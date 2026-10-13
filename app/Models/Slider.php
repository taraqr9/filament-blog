<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $image_path
 * @property bool $is_active
 * @property int $sort_order
 */
class Slider extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
