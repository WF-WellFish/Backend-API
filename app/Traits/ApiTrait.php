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
        $responseData = empty($data) ? new \stdClass() : $data;

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $responseData,
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
        $responseData = empty($data) ? new \stdClass() : $data;

        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $responseData
        ], $code);
    }
}
