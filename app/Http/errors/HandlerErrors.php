<?php

namespace App\Http\errors;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class HandlerErrors
{

    public function handleError(Exception $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'error' => 'Datos de entrada no válidos.',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Modelo no encontrado.',
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'error' => 'Error interno en el servidor.',
            'message' => $e->getMessage(),
            'trace' => env('APP_ENV') === 'local' ? $e->getTraceAsString() : null
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
