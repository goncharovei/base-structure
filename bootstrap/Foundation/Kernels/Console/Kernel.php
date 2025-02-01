<?php

namespace Foundation\Kernels\Console;

use Foundation\Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\Console\Application as ConsoleApplication;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

final class Kernel implements KernelConsole
{
    private array $commandPaths = [];

    public function __construct(private readonly Application $app)
    {

    }

    /**
     * @throws BindingResolutionException
     */
    public function launchConsole(): int
    {
        $console = $this->app->make(ConsoleApplication::class);
        $this->addCommands($console);

        return $console->run();
    }

    public function addCommandPaths(array $paths): KernelConsole
    {
        $this->commandPaths = array_values(array_unique(array_merge($this->commandPaths, $paths)));

        return $this;
    }

    /**
     * @throws BindingResolutionException
     */
    private function addCommands(ConsoleApplication $console): void
    {
        foreach ($this->discoverCommands() as $commandClass)
        {
            $console->add($this->app->make($commandClass));
        }
    }

    private function discoverCommands(): array
    {
        $commands = [];

        foreach ($this->commandPaths as $path)
        {
            $commands = array_merge($commands, $this->load($path));
        }

        return array_unique($commands);
    }

    private function load($paths): array
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

    private function commandClassFromFile(SplFileInfo $file, string $namespace): string
    {
        return $namespace.str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($file->getRealPath(), realpath(app_path()).DIRECTORY_SEPARATOR)
            );
    }

}