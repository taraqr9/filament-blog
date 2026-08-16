<?php

namespace App\Models;

use App\Enums\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $place_id
 * @property Language $language
 * @property string $audio_path
 * @property int $sort_order
 */
class PlaceAudio extends Model
{
    protected $table = 'place_audio';

    protected $guarded = [];

    protected $casts = [
        'language' => Language::class,
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
