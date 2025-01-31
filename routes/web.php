<?php

use App\Http\Controller\HomeController;
use App\Http\Middleware\AppMiddleware;
use Foundation\Kernels\Http\Router;

Router::map('GET', '/', [HomeController::class, 'index'])->middleware(new AppMiddleware());