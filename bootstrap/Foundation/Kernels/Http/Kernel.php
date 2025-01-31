<?php

namespace Foundation\Kernels\Http;

use Foundation\Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Route\Router;
use Symfony\Component\Finder\Finder;

final class Kernel implements KernelHttp
{
    public function __construct(private readonly Application $app)
    {
        $this->bindTemplateEngine();
        $this->registerRequest();
        $this->registerRouter();
        $this->registerResponse();
    }

    /**
     * @throws BindingResolutionException
     */
    public function launchWeb(): void
    {
        $response = router()->dispatch(request());
        (new SapiEmitter())->emit($response);
    }

    public function loadRoutes(string $path): Kernel
    {
        foreach (Finder::create()->files()->name('*.php')->in($path) as $file)
        {
            require_once $file->getRealPath();
        }

        return $this;
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

    private function registerRequest(): void
    {
        $this->app->instance('request', Request::fromGlobals());
    }

    private function registerResponse(): void
    {
        $this->app->instance('response', new Response());
    }
}