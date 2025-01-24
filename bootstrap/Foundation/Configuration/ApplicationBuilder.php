<?php

namespace Foundation\Configuration;

use Foundation\Application;
use Foundation\Configuration\Load\LoadConfig;
use Foundation\Configuration\Load\LoadEnvironmentVariables;

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

}
