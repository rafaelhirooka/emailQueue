<?php


namespace App\Traits;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

trait EmailJob {

    protected $rules = [
        'subject' => 'required',
        'to' => 'required',
        'data' => 'required'
    ];

    public function prepare($data) {
        $v = Validator::make($data, $this->rules);
        if ($v->fails())
            throw new \RuntimeException('Verifique se não esqueceu nenhum parâmetro obrigatório', Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['to'] = is_string($data['to']) ? (array)json_decode($data['to']) : (array)$data['to'];
        $data['data'] = is_string($data['data']) ? (array)json_decode($data['data']) : (array)$data['data'];

        return $data;
    }

    public function queue(ShouldQueue $job, $callback) {
        dispatch($job);

        return $callback();
    }
}