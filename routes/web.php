<?php

use App\Http\Controller\HomeController;
use App\Http\Middleware\AppMiddleware;
use Foundation\Kernels\Http\Router;

Router::group('', function (){
    Router::map('GET', '/', [HomeController::class, 'index'])->setName('home');
})->middleware(new AppMiddleware());
