<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoDB;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    protected $propertyCollection;
    protected $usersCollection;

    public function __construct()
    {
        // Initialize MongoDB connection
        $client = new MongoDB(env('DB_URI'));
        $this->propertyCollection = $client->realestate->property;
        $this->usersCollection = $client->realestate->users;
    }

    // Create method for the /property/create route
    public function create()
    {
        // Check if the user is logged in by checking the session
        if (!session()->has('user')) {
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        return view('property');
    }

    /**
     * Store the property data in the database.
     */
    public function store(Request $request)
    {
        // Check if the session user exists
        $username = session('user');
        if (!$username) {
            return redirect()->back()->with('error', 'You must be logged in to post a property.');
        }

        // Fetch user from the users collection
        $user = $this->usersCollection->findOne(['name' => $username]);

        // Check if user exists and if verified field is true
        if (!$user || empty($user['verified']) || $user['verified'] !== true) {
            return redirect()->back()->with('error', 'Email not verified. Please verify your email before posting.');
        }

        // Validate the property data
        $validatedData = $request->validate([
            'property_title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'max_rooms' => 'required|numeric',
            'beds' => 'required|numeric',
            'baths' => 'required|numeric',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'video_link' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string',
            'whatsapp_number' => 'required|string',
            'created_at' => 'required|string',
            'created_by' => 'required|string',
        ]);

        // Handle multiple image uploads
        $imagePaths = [];
        for ($i = 1; $i <= 8; $i++) {
            $fieldName = "image_$i";
            if ($request->hasFile($fieldName)) {
                $image = $request->file($fieldName);
                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('assets/images/properties');

                // Ensure directory exists
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                // Move the uploaded file
                $image->move($imagePath, $imageName);
                $imagePaths[$fieldName] = 'assets/images/properties/' . $imageName;
            }
        }

        // Merge images into validated data
        $validatedData = array_merge($validatedData, $imagePaths);

        // Insert data into MongoDB
        $this->propertyCollection->insertOne($validatedData);

        return redirect()->back()->with('success', 'Property added successfully!');
    }
}
