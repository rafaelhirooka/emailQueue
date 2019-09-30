<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Traits\ApiResponser;
use App\Traits\EmailJob;
use Illuminate\Http\Request;
use App\Mail\App\RecoverPasswordToken;

class ExampleController extends Controller {

    use ApiResponser, EmailJob;

    public function recoverPasswordToken(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new RecoverPasswordToken($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }
}
