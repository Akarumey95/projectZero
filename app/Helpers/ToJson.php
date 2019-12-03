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
     * @return JsonResponse
     */
    public static function json($data, string $status, int $code, string $message ) : JsonResponse
    {
        return response()->json([
            'status'    => $status,
            'data'      => $data,
            'message'   => $message
        ], $code);
    }

    /**
     * @param $token
     * @param string $status
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    public static function tokenResponse($token, $status="OK", $code=200, $message='User Authorizated') : JsonResponse
    {
        return self::json('Bearer ' . $token, $status, $code, $message);
    }
}
