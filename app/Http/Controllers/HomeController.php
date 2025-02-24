<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        return view('home1');
    }
}
