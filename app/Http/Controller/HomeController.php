<?php

namespace App\Http\Controller;

use Foundation\Kernels\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return response('Hello World!');
    }
}