<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $blog_id
 * @property string $image_path
 * @property int $sort_order
 */
class BlogImage extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
