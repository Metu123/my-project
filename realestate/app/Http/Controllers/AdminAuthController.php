<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as Mongo;

class AdminAuthController extends Controller
{
    protected $collection;

    public function __construct()
    {
        // Retrieve MongoDB credentials from .env
        $mongoUri = env('DB_URI', 'mongodb://admin:12345678@127.0.0.1:27017/realestate?authSource=admin');

        // Connect to MongoDB with authentication
        $this->collection = (new Mongo($mongoUri))->realestate->admin; // Admin collection in MongoDB
    }

    // Show Admin Registration Form
    public function showRegisterForm()
    {
        return view('adminregister'); // Admin register view
    }

    // Handle Admin Registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admin',
            'email' => 'required|email|unique:admin',
            'password' => 'required|min:6',
        ]);

        $admin = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => md5($request->input('password')) // Hash password for security
        ];

        $this->collection->insertOne($admin);

        session(['admin' => $admin['username']]); // Store admin session
        return redirect('/admin/dashboard')->with('success', 'Admin registered successfully');
    }

    // Show Admin Login Form
    public function showLoginForm()
    {
        return view('adminlogin'); // Admin login view
    }

    // Handle Admin Login
    public function login(Request $request)
    {
        $admin = $this->collection->findOne(['email' => $request->input('email')]);

        if ($admin && $admin['password'] === md5($request->input('password'))) {
            session(['admin' => $admin['username']]); // Store admin session
            return redirect('/admin/dashboard')->with('success', 'Logged in successfully');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Handle Admin Logout
    public function logout()
    {
        session()->forget('admin');
        return redirect('/admin/login')->with('success', 'Logged out successfully');
    }

    // Admin Dashboard Access
    public function dashboard()
    {
        if (!session()->has('admin')) {
            return redirect('/admin/login')->with('error', 'You must be logged in as admin to access this page.');
        }

        return view('admindashboard'); // Load admin dashboard
    }
}
