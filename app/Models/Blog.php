<?php

namespace App\Models;

use App\Enums\BlogStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property int $category_id
 * @property string $thumbnail
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property BlogStatus $status
 * @property Carbon published_at
 */
class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => BlogStatus::class,
    ];

    protected static function booted(): void
    {
        static::creating(function (Blog $blog) {
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
