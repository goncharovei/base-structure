<?php

namespace App\Http\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return response('Hello World!');
    }
}