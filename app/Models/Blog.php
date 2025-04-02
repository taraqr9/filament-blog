<?php

namespace App\Models;

use App\Enums\BlogStatus;
use App\Enums\Status;
use App\Jobs\SubscriberNotificationJob;
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
 * @property bool $send_mail
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

        static::created(function (Blog $blog) {
            if ($blog->status === BlogStatus::Published && $blog->send_mail === true) {
                $emails = Subscriber::where('status', Status::Active)->pluck('email')->toArray();
                $emails[] = auth()->user()->email;

                SubscriberNotificationJob::dispatch($blog, $emails);
            }
        });

        static::updating(function (Blog $blog) {
            if ($blog->status === BlogStatus::Published && $blog->send_mail === true && $blog->published_at !== null) {
                // send mail
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
