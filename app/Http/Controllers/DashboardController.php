<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function tables()
    {
        return view('tables');
    }

    public function components()
    {
        return view('components');
    }
}
