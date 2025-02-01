<?php

namespace Foundation\Kernels\Http\View\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('url', [$this, 'url']),
            new TwigFunction('asset', [$this, 'asset']),
        ];
    }

    public function url(string $path = '', array $params = []): string
    {
        return url($path, $params);
    }

    public function asset(string $path, array $params = []): string
    {
        return asset($path, $params);
    }
}