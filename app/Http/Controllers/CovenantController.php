<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Covenant\Register;
use App\Mail\Covenant\RegisterMS;
use App\Traits\ApiResponser;
use App\Traits\EmailJob;
use Illuminate\Http\Request;

class CovenantController extends Controller {

    use ApiResponser, EmailJob;

    private $rules = [
        'subject' => 'required',
        'to' => 'required',
        'data' => 'required'
    ];

    public function register(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new Register($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }

    public function registerMS(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new RegisterMS($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }
}
