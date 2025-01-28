<?php

namespace Foundation\Kernels\Web;

use Foundation\Application;

final class Kernel implements KernelWeb
{
    public function __construct(private readonly Application $app)
    {

    }


    public function launchWeb(): void
    {
        echo 'Hello World!';
    }
}