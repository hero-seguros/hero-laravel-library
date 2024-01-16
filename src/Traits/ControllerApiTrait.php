<?php

namespace HeroSeguros\HeroLaravelLibrary\Traits;

use HeroSeguros\HeroLaravelLibrary\Exceptions\HeroException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ControllerApiTrait
{
    /**
     * Retorna padrão de Sucesso da API
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function returnJsonSuccess(array $data = [], string $customMessage = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        if (!is_null($customMessage)) {
            $response['message'] = $customMessage;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Retorno padrão para exceptions
     * @param \Exception $exception
     * @return JsonResponse
     */
    protected function returnJsonException(string $customMessage, \Exception $exception, int $statusCode = 500): JsonResponse
    {
        $isHeroException = ($exception instanceof HeroException);
        $response = [
            'success' => false,
            'message' => ($isHeroException) ? $exception->getMessage() : $customMessage,
        ];

        $errorData = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
        ];

        if (!$isHeroException) {
            Log::error($exception->getMessage(), $errorData);
        }

        if (config('app.env') == 'local') {
            $response['error'] = $errorData;
        }

        return response()->json($response, $statusCode);
    }
}