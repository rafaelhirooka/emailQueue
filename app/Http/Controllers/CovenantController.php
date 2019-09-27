<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Covenant\Register;
use App\Mail\Covenant\RegisterMS;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CovenantController extends Controller {

    use ApiResponser;

    private $rules = [
        'subject' => 'required',
        'to' => 'required',
        'data' => 'required'
    ];

    public function register(Request $request) {
        $data = $request->all();

        $v = Validator::make($data, $this->rules);
        if ($v->fails())
            throw new \RuntimeException('Verifique se não esqueceu nenhum parâmetro obrigatório', Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['to'] = is_string($data['to']) ? (array)json_decode($data['to']) : (array)$data['to'];
        $data['data'] = is_string($data['data']) ? (array)json_decode($data['data']) : (array)$data['data'];
        dispatch(new SendEmailJob(new Register($data['subject'], $data['data']), $data['to']));

        return $this->successResponse('queue');
    }

    public function registerMS(Request $request) {
        $data = $request->all();

        $v = Validator::make($data, $this->rules);
        if ($v->fails())
            throw new \RuntimeException('Verifique se não esqueceu nenhum parâmetro obrigatório', Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['to'] = is_string($data['to']) ? (array)json_decode($data['to']) : (array)$data['to'];
        $data['data'] = is_string($data['data']) ? (array)json_decode($data['data']) : (array)$data['data'];
        dispatch(new SendEmailJob(new RegisterMS($data['subject'], $data['data']), $data['to']));

        return $this->successResponse('queue');
    }
}
