<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }
}
