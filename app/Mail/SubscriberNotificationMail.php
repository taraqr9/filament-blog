<?php

namespace App\Mail;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriberNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Blog $blog;

    public string $email;

    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($blog, $email)
    {
        $this->blog = $blog;
        $this->email = $email;
        $this->subject = 'New Blog Alert: '.$this->blog->title.' – Read Now!';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.subscriber_from'), 'Blog Alert'),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.blog.subscriber',
            with: [
                'subject' => $this->subject,
                'blog' => $this->blog,
                'email' => $this->email,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
