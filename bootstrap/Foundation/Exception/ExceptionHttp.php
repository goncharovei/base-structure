<?php

namespace Foundation\Exception;

use Foundation\Kernels\Http\View;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

final class ExceptionHttp implements ExceptionOutput
{
    public function __construct(
        private View $view, private string $pathTemplate)
    {

    }

    public function show(\Throwable $exception): void
    {
        $statusCode = $exception->getCode() ?: 500;
        $errorText = $exception->getMessage() . ' ' . $exception->getFile() . '(' . $exception->getLine() . ').';
        $response = $this->view->response($this->pathTemplate, [
            'statusCode' => $statusCode,
            'errorText' => $errorText,
            'trace' => nl2br($exception->getTraceAsString())
        ]);
        $response->withStatus($statusCode);

        (new SapiEmitter())->emit($response);
    }
}