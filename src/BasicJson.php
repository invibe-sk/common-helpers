<?php


namespace Invibe\CommonHelpers;

use Illuminate\Http\JsonResponse;

/**
 * Class BasicJson
 * @author Adam Ondrejkovic
 * @package Invibe\CommonHelpers
 */
class BasicJson
{
    /**
     * @param bool $result
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @author Adam Ondrejkovic
     */
    public function response(bool $result, $data) : JsonResponse
    {
        return response()->json([
            'result' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @author Adam Ondrejkovic
     */
    public function responseTrue($data) : JsonResponse
    {
        return $this->response(true, $data);
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @author Adam Ondrejkovic
     */
    public function responseFalse($data) : JsonResponse
    {
        return $this->response(false, $data);
    }
}