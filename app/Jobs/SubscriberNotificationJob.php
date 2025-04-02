<?php

namespace App\Jobs;

use App\Mail\SubscriberNotificationMail;
use App\Models\Blog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SubscriberNotificationJob implements ShouldQueue
{
    use Queueable;

    public Blog $blog;

    public array $emails;

    /**
     * Create a new job instance.
     */
    public function __construct($blog, $emails)
    {
        $this->blog = $blog;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->emails as $email) {
            Mail::to($email)->send(new SubscriberNotificationMail($this->blog, $email));
        }
    }
}
