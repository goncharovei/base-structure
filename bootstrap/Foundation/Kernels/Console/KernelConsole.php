<?php

namespace Foundation\Kernels\Console;

use Foundation\Kernels\Kernel;

interface KernelConsole extends Kernel
{
    public function addCommandPaths(array $paths): KernelConsole;
    public function launchConsole(): int;
}