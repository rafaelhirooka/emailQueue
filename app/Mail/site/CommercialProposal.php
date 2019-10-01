<?php

namespace App\Mail\Site;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommercialProposal extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;

    private $rules = [
        'company' => 'required',
        'cnpj' => 'required',
        'employees' => 'required',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required'
    ];

    public function __construct($subject, $details) {
        $this->details = $details;
        $this->subject = $subject;
    }

    public function build() {
        return $this->from(config('mail.vegas.from.address'), config('mail.vegas.from.name'))
            ->replyTo($this->details['email'])
            ->subject($this->subject)
            ->view('mails.site.commercial-proposal')
            ->with($this->details);
    }
}
