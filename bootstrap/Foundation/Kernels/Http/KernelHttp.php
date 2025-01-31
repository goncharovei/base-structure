<?php

namespace Foundation\Kernels\Http;

use Foundation\Kernels\Kernel;

interface KernelHttp extends Kernel
{
    public function launchWeb(): void;
    public function loadRoutes(string $path): \Foundation\Kernels\Http\Kernel;
}