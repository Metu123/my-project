<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        if (!session('auth')) {
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        return view('test');
    }
}
