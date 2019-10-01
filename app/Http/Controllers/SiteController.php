<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Site\Accreditation;
use App\Mail\Site\CommercialProposal;
use App\Traits\ApiResponser;
use App\Traits\EmailJob;
use Illuminate\Http\Request;

class SiteController extends Controller {

    use ApiResponser, EmailJob;

    public function accreditation(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new Accreditation($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }

    public function commercialProposal(Request $request) {
        $data = $this->prepare($request->all());

        return $this->queue(new SendEmailJob(new CommercialProposal($data['subject'], $data['data']), $data['to']), function() {
            return $this->successResponse('queue');
        });
    }
}
