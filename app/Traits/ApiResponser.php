<?php


namespace App\Traits;


use Illuminate\Http\Response;
/**
 * Trait ApiResponser
 * @package App\Traits
 */
trait ApiResponser {

    private $codes = [
        100,101,102,103,200,201,202,203,204,205,206,207,208,226,300,301,302,303,304,305,306,307,308,
        400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,421,422,423,424,
        426,428,429,431,451,500,501,502,503,504,505,506,507,508,510,511
    ];

    /**
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK) {
        $code = $this->checkCode($code) ? $code : Response::HTTP_OK;
        return \response()->json(['response' => $data], $code, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    /**
     * @param string|array $message
     * @param $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code) {
        $code = $this->checkCode($code) ? $code : Response::HTTP_BAD_REQUEST;

        return \response()->json(['response' => ['message' => $message]], $code);
    }

    private function checkCode($code) {
        return $r = in_array($code, $this->codes) ? true : false;
    }
}