<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class TestSearchController extends Controller
{
    public function search(Request $request)
    {
        // Connect to MongoDB
        $client = new Client(env('DB_URI'));
        $propertyCollection = $client->realestate->property;
        $dataCollection = $client->realestate->data;

        // Build search query
        $query = [];

        // Case-insensitive search for city, status, and type
        if ($request->filled('city')) {
            $query['city'] = ['$regex' => '^' . preg_quote($request->city) . '$', '$options' => 'i'];
        }
        if ($request->filled('status')) {
            $query['status'] = ['$regex' => '^' . preg_quote($request->status) . '$', '$options' => 'i'];
        }
        if ($request->filled('type')) {
            $query['type'] = ['$regex' => '^' . preg_quote($request->type) . '$', '$options' => 'i'];
        }

        // Fetch results from MongoDB
        $cursor = $propertyCollection->find($query);
        $results = iterator_to_array($cursor); // Convert cursor to an array

        // Update view count for each property in search results
        foreach ($results as $property) {
            $propertyId = $property['_id'];
            $existingData = $dataCollection->findOne(['property_id' => $propertyId]);

            if ($existingData) {
                // Increment view count if entry exists
                $dataCollection->updateOne(
                    ['property_id' => $propertyId],
                    ['$inc' => ['views' => 1]]
                );
            } else {
                // Create new entry if it doesn't exist
                $dataCollection->insertOne([
                    'property_id' => $propertyId,
                    'views' => 1
                ]);
            }
        }

        return view('testsearch', [
            'results' => $results,
        ]);
    }
}
