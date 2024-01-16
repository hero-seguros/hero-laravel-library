<?php

namespace HeroSeguros\HeroLaravelLibrary\Traits;

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
    protected function returnSuccess(array $data = [], string $customMessage = null, int $statusCode = 200): JsonResponse
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
    protected function returnException(string $customMessage, \Exception $exception, int $statusCode = 500): JsonResponse
    {
        $isHeroException = ($exception instanceof \App\Exceptions\HeroException);
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

    /**
     * @param string $customMessage
     * @param \Exception $exception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function returnoViewError(string $customMessage, \Exception $exception)
    {
        $isHeroException = ($exception instanceof \App\Exceptions\HeroException);
        if (!$isHeroException) {

            $errorData = [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTrace(),
            ];

            Log::error($exception->getMessage(), $errorData);
        }

        return view('Error')->with('errorMessage', (!$isHeroException) ? $customMessage : $exception->getMessage());
    }
}