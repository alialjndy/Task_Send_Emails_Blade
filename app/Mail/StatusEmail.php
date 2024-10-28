<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $tasks ;

    /**
     * Create a new message instance.
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks ;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'pending status tasks',
            from:new Address('no_reply@Ali_Aljendy.com', 'Task Blade System'),
            cc:[new Address('alialjndy874@gmail.com')],
            bcc:[new Address('alialjndy874@gmail.com')],
            replyTo: [new Address('support@TaskBladeSystem.com')],
            tags: ['PendingTasks', 'DailyNotification'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.message',
            with: ['tasks'=>$this->tasks],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
