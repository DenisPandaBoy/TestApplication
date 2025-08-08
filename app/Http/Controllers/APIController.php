<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class APIController
{
    public function responseJson(bool $success = true,int $statusCode = Response::HTTP_OK, mixed $data = [], string $message = '') :JsonResponse
    {
        return response()->json
        ([
          'success' => $success,
          'data' => $data,
          'message' => $message
        ], $statusCode);
    }
}
