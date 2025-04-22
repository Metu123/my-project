<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

class VerificationController extends Controller
{
    private $client;
    public $collection;

    public function __construct()
    {
        $this->client = new Client(env('DB_URI'));
        $this->collection = $this->client->realestate->users;
    }

    // Show verification status
    public function showVerificationPage(Request $request)
    {
        $email = session('user_email');
        if (!$email) {
            return redirect(env('NUXT_URL'))->with('error', 'You need to log in first.');
        }

        $user = $this->collection->findOne(['email' => $email]);

        return view('verify-email', ['user' => $user]);
    }

    // Send verification email
    public function sendVerificationEmail(Request $request)
    {
        $email = session('user_email');
        if (!$email) {
            return redirect(env('NUXT_URL'))->with('error', 'You need to log in first.');
        }

        $user = $this->collection->findOne(['email' => $email]);

        if ($user && !$user['verified']) {
            $verificationToken = bin2hex(random_bytes(32));

            $this->collection->updateOne(
                ['email' => $email],
                ['$set' => ['verification_token' => $verificationToken]]
            );

            Mail::to($email)->send(new VerificationEmail($user['name'], $verificationToken));

            return redirect('/verify-email')->with('success', 'Verification email sent! Check your inbox.');
        }

        return redirect(env('NUXT_URL'))->with('error', 'Your email is already verified.');
    }

    // Verify email with token
    public function verifyEmail($token)
    {
        $user = $this->collection->findOne(['verification_token' => $token]);

        if (!$user) {
            return redirect(env('NUXT_URL'))->with('error', 'Invalid or expired token.');
        }

        $this->collection->updateOne(
            ['_id' => $user['_id']],
            ['$set' => ['verified' => true, 'verification_token' => null]]
        );

        return redirect(env('NUXT_URL'))->with('success', 'Email Verified Successfully!');
    }
}
