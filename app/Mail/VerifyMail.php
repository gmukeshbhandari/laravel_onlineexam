<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;

    public function __construct($verifyUser)
    {
        $this->user = $verifyUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            return $this->subject('Email Verification')->view('emails.verifyuser');
    }
}
