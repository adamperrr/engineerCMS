<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fromName, $fromEmail, $subject, $content)
    {
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('pages-guest.email', [
            'email' => [
                'fromName' => $this->fromName,
                'fromEmail' => $this->fromEmail,
                'subject' => $this->subject,
                'content' => $this->content
            ]
        ]);
    }

    private $fromName;
    private $fromEmail;
    private $content;
}
