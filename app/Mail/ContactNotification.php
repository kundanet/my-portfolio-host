<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($name, $email, $message)
    {
        $this->data = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
        ];
    }

    public function build()
    {
        return $this->subject('New Contact Message')
                    ->view('emails.contact');
    }
}
