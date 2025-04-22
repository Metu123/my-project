<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use MongoDB\Client as MongoClient;

class ProfileController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $client = new MongoClient(env('DB_URI'));
        $this->collection = $client->realestate->profile;
    }

    // Show Profile Page
    public function showProfile()
    {
        $username = session('user');

        if (!$username) {
            return redirect()->route('login')->with('error', 'Please log in to access your profile.');
        }

        $profile = $this->collection->findOne(['username' => $username]);

        return view('edit_profile', ['profile' => $profile ?? null]);
    }

    // Update or Add Profile
    public function updateProfile(Request $request)
    {
        $username = session('user');
        $email = session('user_email'); // Get the session email

        if (!$username || !$email) {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'gender'        => 'required|string',
            'birthday'      => 'required|date',
            'address'       => 'required|string|max:255',
            'city'          => 'required|string|max:255',
            'phone_number'  => 'required|string|max:15',
            'description'   => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileData = [
            'username'     => $username,
            'email'        => $email, // Store the email in the profile
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'gender'       => $request->gender,
            'birthday'     => $request->birthday,
            'address'      => $request->address,
            'city'         => $request->city,
            'phone_number' => $request->phone_number,
            'description'  => $request->description,
        ];

        // Handle profile and cover image uploads
        $profileImagePath = $this->uploadImage($request, 'profile_image', "assets/images/profiles/{$username}");
        $coverImagePath = $this->uploadImage($request, 'cover_image', "assets/images/covers/{$username}");

        if ($profileImagePath) {
            $profileData['profile_image'] = $profileImagePath;
        }

        if ($coverImagePath) {
            $profileData['cover_image'] = $coverImagePath;
        }

        // Upsert user profile (Insert if not exists, update if exists)
        $this->collection->updateOne(
            ['username' => $username],
            ['$set' => $profileData],
            ['upsert' => true]
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    // Image Upload Handler
    private function uploadImage(Request $request, $fieldName, $path)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);

            // Ensure the directory exists
            $storagePath = storage_path("app/public/" . $path);
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0755, true, true);
            }

            return $file->store($path, 'public');
        }
        return null;
    }
}
