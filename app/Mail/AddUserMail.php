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
    public $userdata,$randompassword,$authuser;

    /**
     * Create a new message instance.
     */
    public function __construct($userdata,$randompassword,$authuser)
    {
        $this->userdata      =$userdata;
        $this->randompassword=$randompassword;
        $this->authuser      =$authuser;
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
            view: 'emails.addusermail',
            with:[
                'userdata'       =>$this->userdata,
                'randompassword' =>$this->randompassword,
                'authuser'       =>$this->authuser
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
