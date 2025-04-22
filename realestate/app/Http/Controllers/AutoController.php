<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AutoController extends Controller
{
    private $client;
    private $collection;
    private $allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com', 'icloud.com', 'protonmail.com'];

    public function __construct()
    {
        $this->client = new Client(env('DB_URI'));
        $this->collection = $this->client->realestate->users;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = strtolower($request->email);
        $emailParts = explode('@', $email);
        if (count($emailParts) !== 2 || !in_array($emailParts[1], $this->allowedDomains)) {
            return redirect('/')->with('error', 'Only top email providers are allowed!');
        }

        $existingUser = $this->collection->findOne([
            '$or' => [
                ['email' => $email],
                ['name' => $request->name]
            ]
        ]);

        if ($existingUser) {
            return redirect('/')->with('error', 'Name or Email already exists!');
        }

        $hashedPassword = Hash::make($request->password);
        $verificationToken = bin2hex(random_bytes(32));

        $this->collection->insertOne([
            'name' => $request->name,
            'email' => $email,
            'password' => $hashedPassword,
            'verified' => false,
            'verification_token' => $verificationToken,
            'created_at' => now(),
        ]);

        session([
            'auth' => true,
            'user' => $request->name,
            'user_email' => $email
        ]);

        return redirect('/')->with('success', 'Registration successful! You are logged in. Consider verifying your email.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->collection->findOne(['email' => strtolower($request->email)]);

        if ($user && Hash::check($request->password, $user['password'])) {
            session([
                'auth' => true,
                'user' => $user['name'],
                'user_email' => $user['email']
            ]);

            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return redirect('/')->with('error', 'Invalid credentials!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
