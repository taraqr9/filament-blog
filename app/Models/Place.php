<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $city_id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property array|null $images
 * @property Status $status
 * @property int $sort_order
 */
class Place extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => Status::class,
        'images' => 'array',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function audios(): HasMany
    {
        return $this->hasMany(PlaceAudio::class)->orderBy('sort_order');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
