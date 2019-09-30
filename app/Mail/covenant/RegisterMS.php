<?php

namespace App\Mail\Covenant;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMS extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;

    private $rules = [
        'name' => 'required',
        'login' => 'required',
        'password' => 'required',
    ];

    public function __construct($subject, $details) {
        $this->details = $details;
        $this->subject = $subject;
    }

    public function build() {
        return $this->from(config('mail.ms.from.address'), config('mail.ms.from.name'))
            ->replyTo(config('mail.ms.reply_to'))
            ->subject($this->subject)
            ->view('mails.covenant.register-ms')
            ->with($this->details);
    }
}
