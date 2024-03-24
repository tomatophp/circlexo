<?php

namespace Modules\TomatoCrm\App\Helpers;

use Illuminate\Http\JsonResponse;

class Response
{
    public static function success(string $message = null, mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error(string $message = null, mixed $data = null,  int $code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
