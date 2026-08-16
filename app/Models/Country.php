<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 * @property string $slug
 * @property string|null $code
 * @property Status $status
 */
class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => Status::class,
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
