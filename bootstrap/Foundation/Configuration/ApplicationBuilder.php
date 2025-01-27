<?php

namespace Foundation\Configuration;

use Foundation\Application;
use Foundation\Configuration\Load\LoadConfig;
use Foundation\Configuration\Load\LoadEnvironmentVariables;
use Foundation\Database\QueryBuilder;
use Foundation\Log\Logger;
use Foundation\Mail\Mailer;
use Illuminate\Contracts\Container\Container;
use Psr\Log\LoggerInterface;

class ApplicationBuilder
{
    /**
     * Create a new application builder instance.
     */
    public function __construct(protected Application $app)
    {
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
