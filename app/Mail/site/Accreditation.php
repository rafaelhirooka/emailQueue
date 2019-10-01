<?php

namespace App\Mail\Site;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Accreditation extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;

    private $rules = [
        'accept' => 'required',
        'account' => 'required',
        'agency' => 'required',
        'bank' => 'required',
        'accountType' => 'required',
        'favored' => 'required',
        'segment' => 'required',
        'capture' => 'required',
        'cep' => 'required',
        'city' => 'required',
        'cnpj' => 'required',
        'company' => 'required',
        'cpf' => 'required',
        'ddd' => 'required',
        'email' => 'required',
        'fantasy' => 'required',
        'neighborhood' => 'required',
        'number' => 'required',
        'owner' => 'required',
        'birthday' => 'required',
        'phone' => 'required',
        'state' => 'required',
        'street' => 'required',
        'dddC' => 'required',
        'phoneC' => 'required',
    ];

    public function __construct($subject, $details) {
        $this->details = $details;
        $this->subject = $subject;
    }

    public function build() {
        return $this->from(config('mail.vegas.from.address'), config('mail.vegas.from.name'))
            ->replyTo($this->details['email'])
            ->subject($this->subject)
            ->view('mails.site.accreditation')
            ->with($this->details);
    }
}
