<?php

namespace Foundation\Configuration;

use Foundation\Application;
use Foundation\Configuration\Load\LoadConfig;
use Foundation\Configuration\Load\LoadEnvironmentVariables;
use Foundation\Database\QueryBuilder;
use Foundation\Kernels\Kernel;
use Foundation\Kernels\Console\Kernel as ConsoleKernel;
use Foundation\Kernels\Http\Kernel as WebKernel;
use Foundation\Log\Logger;
use Foundation\Mail\Mailer;

class ApplicationBuilder
{
    /**
     * Create a new application builder instance.
     */
    public function __construct(private Application $app)
    {
    }

    public function createKernel(): Kernel
    {
        $kernel = $this->app->runningInConsole() ?
            ConsoleKernel::class : WebKernel::class;

        return $this->app->make($kernel, ['app' => $this->app]);
    }

    public function loadSettings(): static
    {
        $this->app->make(LoadEnvironmentVariables::class)->load($this->app);
        $this->app->make(LoadConfig::class)->load($this->app);

        return $this;
    }

    public function createLogger(): static
    {
        $this->app->instance('log', call_user_func(new Logger()));

        return $this;
    }

    public function createMailer(): static
    {
        $this->app->instance('mailer', call_user_func(new Mailer()));

        return $this;
    }

    public function createQueryBuilder(): static
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder()->setAsGlobal();

        return $this;
    }

}
