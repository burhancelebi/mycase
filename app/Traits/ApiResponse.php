<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param $status
     * @return JsonResponse
     */
    protected function successResponse($data = null, $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'İşlem başarılı'
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @param $data
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $status = 400, $data = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ], $status);
    }
}
