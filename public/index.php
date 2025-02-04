<?php

require __DIR__ . '/../vendor/autoload.php';

(require_once __DIR__.'/../bootstrap/app.php')
    ->registerExceptionOutput(pathTemplate: 'error.html.twig')
    ->loadRoutes(base_path('routes'))
    ->launchWeb();

