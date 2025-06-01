<?php

namespace App\Http\Controllers;

use MongoDB\Client as MongoDB;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    protected $collection;

    public function __construct()
    {
        // Initialize MongoDB connection
        $client = new MongoDB(env('DB_URI'));
        $this->collection = $client->realestate->property;
    }

    public function show($id)
    {
        // Find the property by ID
        $property = $this->collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

        // If no property is found, show a 404 error
        if (!$property) {
            abort(404, 'Property not found');
        }

        // Convert the MongoDB document to an array
        $property = json_decode(json_encode($property), true);

        // Return the view with the property data
        return view('property.show', compact('property'));
    }
}
