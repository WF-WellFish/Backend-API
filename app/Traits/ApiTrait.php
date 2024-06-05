<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiTrait
{
    /**
     * Return a success JSON response.
     *
     * @param array $data
     * @param string $message
     * @param int|string $code
     * @return JsonResponse
     */
    public function success(array $data = [], string $message = '', int|string $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param array $data
     * @param string $message
     * @param int|string $code
     * @return JsonResponse
     */
    public function error(array $data = [], string $message = '', int|string $code = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
