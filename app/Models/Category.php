<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $description
 * @property Status $status
 */
class Category extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => Status::class,
    ];

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }
}
