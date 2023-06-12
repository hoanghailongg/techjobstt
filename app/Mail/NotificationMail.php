<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    public function build()
    {
        \Log::info($this->message);
        return $this->subject($this->subject)->view('email.notification', [
            'content' => $this->message,
        ]);
    }
}
