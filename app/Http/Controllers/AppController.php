<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Traits\ApiResponser;
use App\Traits\EmailJob;
use Illuminate\Http\Request;
use App\Mail\App\RecoverPasswordToken;
use App\Mail\App\RecoverPasswordTokenMS;
use App\Mail\App\Register;

class AppController extends Controller {

    use ApiResponser, EmailJob;

    public function recoverPasswordToken(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new RecoverPasswordToken($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }

    public function recoverPasswordTokenMS(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new RecoverPasswordTokenMS($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }

    public function register(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new Register($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }
}
