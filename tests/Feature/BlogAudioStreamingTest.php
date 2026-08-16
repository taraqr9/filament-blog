<?php

use App\Enums\BlogStatus;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

it('serves audio with proper range support so the browser can stream/seek it', function () {
    Storage::fake('public');
    Storage::disk('public')->put('range-test.mp3', str_repeat('a', 2000));

    $admin = User::where('username', 'admin')->first();
    $blog = Blog::create([
        'user_id' => $admin->id,
        'title' => 'Range Test',
        'slug' => 'range-test-'.uniqid(),
        'thumbnail' => 'thumb.jpg',
        'content' => 'Content.',
        'status' => BlogStatus::Published,
    ]);
    $audio = $blog->audios()->create(['language' => 'English', 'audio_path' => 'range-test.mp3', 'sort_order' => 0]);

    $full = $this->get(route('blog.audio', $audio));
    $full->assertOk();
    $full->assertHeader('Accept-Ranges', 'bytes');

    $partial = $this->withHeaders(['Range' => 'bytes=0-99'])->get(route('blog.audio', $audio));
    $partial->assertStatus(206);
    $partial->assertHeader('Content-Range', 'bytes 0-99/2000');
    $partial->assertHeader('Content-Length', '100');

    $blog->forceDelete();
});

it('does not serve audio belonging to an unpublished blog', function () {
    Storage::fake('public');
    Storage::disk('public')->put('draft-audio.mp3', 'x');

    $admin = User::where('username', 'admin')->first();
    $blog = Blog::create([
        'user_id' => $admin->id,
        'title' => 'Draft Blog',
        'slug' => 'draft-blog-'.uniqid(),
        'thumbnail' => 'thumb.jpg',
        'content' => 'Content.',
        'status' => BlogStatus::Draft,
    ]);
    $audio = $blog->audios()->create(['language' => 'English', 'audio_path' => 'draft-audio.mp3', 'sort_order' => 0]);

    $this->get(route('blog.audio', $audio))->assertNotFound();

    $blog->forceDelete();
});
