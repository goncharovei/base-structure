<?php

namespace Foundation\Kernels\Http;

use Foundation\Application;
use GuzzleHttp\Psr7\ServerRequest;
use League\Route\Router;

final class Kernel implements KernelHttp
{
    public function __construct(private readonly Application $app)
    {
        $this->bindTemplateEngine();
        $this->registerRouter();
    }

    public function launchWeb(): void
    {
        $request = ServerRequest::fromGlobals();

        //Router::map('GET', '/', [HomeController::class, 'index'])->middleware(new AppMiddleware());
        echo 'Hello World!';
    }

    private function bindTemplateEngine(): void
    {
        $this->app->bind(\Twig\Environment::class, function (){
           return new \Twig\Loader\FilesystemLoader($this->app->resourcePath('view'));
        });
    }

    private function registerRouter(): void
    {
        $this->app->instance('router', new Router());
    }
}