<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoClient;

class FavoriteController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $client = new MongoClient(env('DB_URI'));
        $this->collection = $client->realestate->favorite; // 'realestate' is your DB, 'favorite' is your collection
    }

    // Show favorite properties with pagination
    public function index(Request $request)
    {
        $username = session('user');
        if (!$username) {
            return redirect('/')->with('error', 'Please log in to view your favorite properties.');
        }

        $perPage = 6; // Number of properties per page
        $currentPage = max(1, (int) $request->query('page', 1));
        $skip = ($currentPage - 1) * $perPage;

        // Fetch favorite property IDs for the logged-in user
        $favoriteRecords = $this->collection->find(['username' => $username]);
        $favoritePropertyIds = [];
        foreach ($favoriteRecords as $record) {
            $favoritePropertyIds[] = (string) $record['property_id']; // Convert to string for easy comparison in Blade
        }

        // Fetch property details
        $propertyCollection = (new MongoClient())->realestate->property;
        $totalProperties = $propertyCollection->countDocuments(['_id' => ['$in' => array_map(fn($id) => new \MongoDB\BSON\ObjectId($id), $favoritePropertyIds)]]);
        $totalPages = max(1, ceil($totalProperties / $perPage));

        $properties = $propertyCollection->find(
            ['_id' => ['$in' => array_map(fn($id) => new \MongoDB\BSON\ObjectId($id), $favoritePropertyIds)]],
            ['limit' => $perPage, 'skip' => $skip]
        )->toArray();

        return view('favourite', compact('properties', 'totalPages', 'currentPage', 'favoritePropertyIds'));
    }

    // Toggle favorite property
    public function toggle(Request $request)
    {
        $username = session('user');
        if (!$username) {
            return redirect('/login')->with('error', 'Please log in to manage your wishlist.');
        }

        $propertyId = $request->input('property_id');
        if (!$propertyId) {
            return redirect()->back()->with('error', 'Property ID is required.');
        }

        $existingFavorite = $this->collection->findOne(['username' => $username, 'property_id' => $propertyId]);

        if ($existingFavorite) {
            $this->collection->deleteOne(['username' => $username, 'property_id' => $propertyId]);
            return redirect()->back()->with('message', 'Removed from wishlist');
        } else {
            $this->collection->insertOne(['username' => $username, 'property_id' => $propertyId]);
            return redirect()->back()->with('message', 'Added to wishlist');
        }
    }
}
