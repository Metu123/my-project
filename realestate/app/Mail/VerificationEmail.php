<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $verificationToken;
    public $websiteUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $verificationToken)
    {
        $this->name = $name;
        $this->verificationToken = $verificationToken;
        $this->websiteUrl = env('APP_URL', 'http://localhost'); // Default to localhost if not set
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $verificationLink = $this->websiteUrl . '/verify-email/' . $this->verificationToken;

        return $this->subject('Verify Your Email')
                    ->view('emails.verify')
                    ->with([
                        'name' => $this->name,
                        'verificationLink' => $verificationLink,
                    ]);
    }
}
