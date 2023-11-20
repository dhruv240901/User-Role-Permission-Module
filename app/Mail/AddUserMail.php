<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddUserMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user,$randomPassword,$authUser;

    /**
     * Create a new message instance.
     */
    public function __construct($user,$randomPassword,$authUser)
    {
        $this->user           = $user;
        $this->randomPassword = $randomPassword;
        $this->authUser       = $authUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Add User Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.addUserMail',
            with:[
                'user'           => $this->user,
                'randomPassword' => $this->randomPassword,
                'authUser'       => $this->authUser
            ]
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
