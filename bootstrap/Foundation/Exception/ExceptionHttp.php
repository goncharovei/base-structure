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
        $response = $this->view->response($this->pathTemplate, []);
        (new SapiEmitter())->emit($response);
    }
}