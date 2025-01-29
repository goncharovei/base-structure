<?php

namespace Foundation\Kernels\Http;

use Foundation\Application;

final class Kernel implements KernelHttp
{
    public function __construct(private readonly Application $app)
    {

    }


    public function launchWeb(): void
    {
        echo 'Hello World!';
    }
}