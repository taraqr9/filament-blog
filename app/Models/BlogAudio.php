<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $blog_id
 * @property string $language
 * @property string $audio_path
 * @property int $sort_order
 */
class BlogAudio extends Model
{
    use SoftDeletes;

    protected $table = 'blog_audios';

    protected $guarded = [];

    /**
     * Common languages offered in the admin dropdown. This is a plain,
     * easily-extended list rather than an enum - adding a language later
     * is a one-line change here, not a migration.
     *
     * @return array<string, string>
     */
    public static function languageOptions(): array
    {
        return [
            'English' => 'English',
            'Bangla' => 'Bangla',
            'Hindi' => 'Hindi',
            'Italian' => 'Italian',
            'French' => 'French',
            'Spanish' => 'Spanish',
            'German' => 'German',
            'Portuguese' => 'Portuguese',
            'Arabic' => 'Arabic',
            'Chinese' => 'Chinese',
            'Japanese' => 'Japanese',
        ];
    }

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
