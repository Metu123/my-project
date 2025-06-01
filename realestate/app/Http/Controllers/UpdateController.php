<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as Mongo;
use MongoDB\BSON\ObjectId;

class UpdateController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $client = new Mongo(env('DB_URI'));
        $this->collection = $client->realestate->property;
    }

    // Show Update Form
    public function edit($id)
    {
        $property = $this->collection->findOne(['_id' => new ObjectId($id)]);

        if (!$property) {
            return redirect('/')->with('error', 'Property not found.');
        }

        // Ensure only the creator can access it
        if (session('user') !== $property['created_by']) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('auth.update', compact('property'));
    }

    // Handle Property Update
    public function update(Request $request, $id)
    {
        $property = $this->collection->findOne(['_id' => new ObjectId($id)]);

        if (!$property) {
            return redirect('/')->with('error', 'Property not found.');
        }

        // Ensure only the creator can update it
        if (session('user') !== $property['created_by']) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Validate form data
        $validatedData = $request->validate([
            'property_title' => 'required|string|max:255',
            'status' => 'required|string',
            'type' => 'required|string',
            'max_rooms' => 'required|integer|min:0',
            'beds' => 'required|integer|min:0',
            'baths' => 'required|integer|min:0',
            'area' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'city' => 'required|string',
            'location' => 'required|string',
            'landmark' => 'nullable|string',
            'video_link' => 'nullable|url',
            'email' => 'required|email',
            'mobile_number' => 'required|string',
            'whatsapp_number' => 'required|string',
        ]);

        // Handle image uploads
        $imageFields = [];
        for ($i = 1; $i <= 8; $i++) {
            if ($request->hasFile("image_$i")) {
                $file = $request->file("image_$i");
                $imageName = time() . "_$i." . $file->getClientOriginalExtension();
                $file->move(public_path('asset/images'), $imageName);
                $imageFields["image_$i"] = "asset/images/$imageName";
            }
        }

        // Update the property
        $updateData = array_merge($validatedData, $imageFields);
        $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $updateData]
        );

        return redirect()->back()->with('success', 'Property added successfully!');
    }
}
