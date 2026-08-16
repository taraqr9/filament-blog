<?php

namespace App\Models;

use App\Enums\BlogStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $user_id
 * @property string $thumbnail
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property BlogStatus $status
 * @property Carbon published_at
 */
class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'status' => BlogStatus::class,
    ];

    protected static function booted(): void
    {
        static::creating(function (Blog $blog) {
            $blog->status ??= BlogStatus::Published;

            if ($blog->status === BlogStatus::Published) {
                $blog->published_at = Carbon::now();
            }
        });

        static::updating(function (Blog $blog) {
            if ($blog->status === BlogStatus::Published && $blog->getOriginal('published_at') === null) {
                $blog->published_at = Carbon::now();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(BlogImage::class)->orderBy('sort_order');
    }

    public function audios(): HasMany
    {
        return $this->hasMany(BlogAudio::class)->orderBy('sort_order');
    }
}
