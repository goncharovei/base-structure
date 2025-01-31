<?php

namespace Foundation\Kernels\Http;

use Foundation\Application;
use GuzzleHttp\Psr7\ServerRequest;
use League\Route\Router;
use Symfony\Component\Finder\Finder;

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

        //
        echo 'Hello World!';
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
}