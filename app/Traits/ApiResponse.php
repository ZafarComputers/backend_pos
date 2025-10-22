<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Return successful response
     */
    protected function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return error response
     */
    protected function error($message = 'Error', $statusCode = 400, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return validation error response
     */
    protected function validationError($errors, $message = 'Validation failed')
    {
        return $this->error($message, 422, $errors);
    }

    /**
     * Return not found response
     */
    protected function notFound($message = 'Resource not found')
    {
        return $this->error($message, 404);
    }

    /**
     * Return unauthorized response
     */
    protected function unauthorized($message = 'Unauthorized')
    {
        return $this->error($message, 401);
    }

    /**
     * Return forbidden response
     */
    protected function forbidden($message = 'Forbidden')
    {
        return $this->error($message, 403);
    }
}