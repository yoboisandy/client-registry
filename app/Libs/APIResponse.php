<?php

namespace App\Libs;

use Illuminate\Http\JsonResponse;

class APIResponse
{
    /**
     * success response method.
     *
     * @param mix $data
     * @param string $message
     * @return JsonResponse
     */
    public static function success($data = null, $message = null): JsonResponse
    {
        $result = [
            'success' => true
        ];
        if (!empty($data)) {
            $result['data'] = $data;
        }
        if ($message) {
            $result['message'] = $message;
        }
        return response()->json($result);
    }

    /**
     * error response method.
     *
     * @param mix $data
     * @param string $message
     * @return JsonResponse
     */
    public static function error($data = null, $message = null, $code = 500): JsonResponse
    {
        $result = [
            'success' => false
        ];
        if (!empty($data)) {
            $result['data'] = $data;
        }
        if ($message) {
            $result['message'] = $message;
        }
        return response()->json($result, $code);
    }
}
