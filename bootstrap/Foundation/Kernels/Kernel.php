<?php

namespace Foundation\Kernels;

use Foundation\Application;

abstract class Kernel
{
    public function __construct(protected Application $app)
    {

    }
    public function getInstance(): Application
    {
        return $this->app;
    }
}