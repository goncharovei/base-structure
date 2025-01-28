<?php

namespace Foundation\Kernels\Web;

use Foundation\Kernels\Kernel;

interface KernelWeb extends Kernel
{
    public function launchWeb(): void;
}