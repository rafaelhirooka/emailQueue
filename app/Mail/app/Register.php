<?php

namespace App\Mail\App;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;

    private $rules = [

    ];

    public function __construct($subject, $details) {
        $this->details = $details;
        $this->subject = $subject;
    }

    public function build() {
        return $this->from(config('mail.vegas.from.address'), config('mail.vegas.from.name'))
            ->replyTo(config('mail.vegas.reply_to'))
            ->subject($this->subject)
            ->view('mails.app.register')
            ->with($this->details);
    }
}
