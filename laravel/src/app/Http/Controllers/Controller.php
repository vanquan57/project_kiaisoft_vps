<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class Controller
{
    /**
     * This function is used to return a successful response in JSON format.
     *
     * @param mixed $data The data to be included in the response. If the data is an empty array or object, it will be set to null.
     * 
     * @param int $code The HTTP status code for the response.
     *
     * @return JsonResponse The JSON response with the specified HTTP status code and data.
     */
    public function responseOkAPI(mixed $data = null, int $code = Response::HTTP_OK): JsonResponse
    {
        if (!empty($data)) {
            if (is_array($data)) {
                $data = count($data) > 0 ? $data : null;
            } elseif (is_object($data)) {
                $data = $data->count() > 0 ? $data : null;
            } else {
                $data = $data ? $data : null;
            }
        }

        $output = [
            'success' => config('constants.SUCCESS_OK'),
            'data' => $data,
            'errors' => null
        ];

        return response()->json($output, $code);
    }

    /**
     * This function is used to return an error response in JSON format.
     *
     * @param int $code The HTTP status code for the response.
     * 
     * @param int $error_code The error code to be included in the response.
     * 
     * @param string $message The detailed error message.
     *
     * @param mixed $data The data to be included in the response. If the data is an empty array or object, it will be set to null.
     *
     * @return JsonResponse The JSON response with the specified HTTP status code, error details, and data.
     */
    public function responseErrorAPI(int $code, int $error_code, string $message, mixed $data = null): JsonResponse
    {
        $output = [
            'success' => config('constants.SUCCESS_FALSE'),
            'data' => $data,
            'errors' => [
                'error_code' => $error_code,
                'error_message' => $message
            ]
        ];

        return response()->json($output, $code);
    }
}
