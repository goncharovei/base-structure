<?php

namespace Foundation\Kernels\Console;

use Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Kernel
{
    protected array $commandPaths = [];

    public function __construct(protected Application $app)
    {
    }

    public function addCommandPaths(array $paths): static
    {
        $this->commandPaths = array_values(array_unique(array_merge($this->commandPaths, $paths)));

        return $this;
    }

    protected function discoverCommands(): array
    {
        $commands = [];

        foreach ($this->commandPaths as $path)
        {
            $commands = array_merge($commands, $this->load($path));
        }

        return array_unique($commands);
    }

    protected function load($paths): array
    {
        $commands = [];

        $paths = array_unique(Arr::wrap($paths));
        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });
        if (empty($paths))
        {
            return $commands;
        }

        $namespace = $this->app->getNamespace();
        foreach (Finder::create()->in($paths)->files() as $file)
        {
            $command = $this->commandClassFromFile($file, $namespace);

            if (is_subclass_of($command, Command::class) &&
                !(new ReflectionClass($command))->isAbstract())
            {
                $commands[] = $command;
            }
        }

        return $commands;
    }

    protected function commandClassFromFile(SplFileInfo $file, string $namespace): string
    {
        return $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getRealPath(), realpath(app_path()).DIRECTORY_SEPARATOR)
            );
    }

}