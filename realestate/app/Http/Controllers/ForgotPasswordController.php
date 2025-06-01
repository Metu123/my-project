<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use MongoDB\Client;

class ForgotPasswordController extends Controller
{
    protected $usersCollection;
    protected $passwordResetsCollection;

    public function __construct()
    {
        $client = new Client(env('DB_URI'));
        $db = $client->realestate;
        $this->usersCollection = $db->users;
        $this->passwordResetsCollection = $db->password_resets;
    }

    public function showForgotForm()
    {
        return view('auth.forgot_password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Find user in the MongoDB database
        $user = $this->usersCollection->findOne(['email' => $email]);

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        // Generate a unique reset token
        $token = Str::random(60);

        // Store the token in the password_resets collection
        $this->passwordResetsCollection->updateOne(
            ['email' => $email],
            ['$set' => ['token' => $token, 'created_at' => now()]],
            ['upsert' => true]
        );

        // Generate the reset link
        $resetLink = url("/reset-password/$token");

        // Send email
        Mail::to($email)->send(new ResetPasswordMail($resetLink));

        return back()->with('success', 'Password reset link sent to your email.');
    }

    public function showResetForm($token)
    {
        return view('auth.reset_password', compact('token'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $email = $request->input('email');
        $token = $request->input('token');
        $newPassword = bcrypt($request->input('password'));

        // Check if token exists
        $resetEntry = $this->passwordResetsCollection->findOne([
            'email' => $email,
            'token' => $token,
        ]);

        if (!$resetEntry) {
            return back()->with('error', 'Invalid or expired token.');
        }

        // Update user's password
        $this->usersCollection->updateOne(
            ['email' => $email],
            ['$set' => ['password' => $newPassword]]
        );

        // Delete the reset token after use
        $this->passwordResetsCollection->deleteOne(['email' => $email]);

        return redirect('/')->with('success', 'Password has been reset successfully.');
    }
}
