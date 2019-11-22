<?php

namespace App\Helpers;

use \Illuminate\Http\JsonResponse;

class ToJson
{
    /**
     * @param $data
     * @param string $status
     * @param int $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json($data, string $status, int $code, string $message ) : JsonResponse
    {
        return response()->json([
            'status'    => $status,
            'data'      => $data,
            'message'   => $message
        ], $code);
    }

}