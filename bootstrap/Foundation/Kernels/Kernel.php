<?php

namespace Foundation\Kernels;

use Foundation\Application;

interface Kernel
{
    public function __construct(Application $app);
}