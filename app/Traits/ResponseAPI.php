<?php

namespace App\Traits;

trait ResponseAPI
{

    public function coreResponse(string $message, ?object $data, int $statusCode, $isSuccess = true): object
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public function success(string $message, ?object $data, int $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    public function error(string $message, int $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}