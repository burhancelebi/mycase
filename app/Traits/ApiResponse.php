<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ApiResponse
{
    /**
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    protected function successResponse($data = null, int $status = 200): JsonResponse
    {
        if ($data instanceof AnonymousResourceCollection
            && $data->resource instanceof Paginator) {

            return response()->json([
                'success' => true,
                'data' => $data->items(),
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                ],
                'message' => 'İşlem başarılı'
            ], $status);
        }

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
