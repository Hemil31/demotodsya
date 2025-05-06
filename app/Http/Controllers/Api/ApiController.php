<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class ApiController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $locale;

    public function __construct()
    {
        $this->locale = app()->getLocale();
    }

    /**
     * Handle a successful response.
     *
     * @param mixed $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function success($result, string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * Handle an error response.
     *
     * @param string $errorMessage
     * @param array $errors
     * @param int $code
     * @return JsonResponse
     */
    public function error(string $errorMessage, array $errors = [], int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $errorMessage,
            'errors' => $errors,
        ];
        return response()->json($response, $code);
    }

    /**
     * Log an error message.
     *
     * @param string $message
     * @return void
     */
    protected function logError(string $message): void
    {
        // Example of logging an error
        \Log::error($message);
    }
}
