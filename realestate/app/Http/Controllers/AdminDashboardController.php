<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class AdminDashboardController extends Controller
{
    protected $mongoClient;
    protected $propertyCollection;
    protected $dataCollection;

    public function __construct()
    {
        // Retrieve MongoDB credentials from .env
        $mongoUri = env('DB_URI', 'mongodb://admin:12345678@127.0.0.1:27017/realestate?authSource=admin');

        // Connect to MongoDB with authentication
        $this->mongoClient = new Client($mongoUri);
        $this->propertyCollection = $this->mongoClient->realestate->property;
        $this->dataCollection = $this->mongoClient->realestate->data;
    }

    public function index(Request $request)
    {
        if (!session()->has('admin')) {
            return redirect('/admin/login')->with('error', 'You must be logged in as admin to access this page.');
        }

        // Search functionality
        $searchQuery = $request->input('search');
        $filter = [];

        if ($searchQuery) {
            // Check if search is a valid MongoDB ObjectId (Property ID)
            if (preg_match('/^[0-9a-fA-F]{24}$/', $searchQuery)) {
                $filter['_id'] = new ObjectId($searchQuery);
            } else {
                $filter['property_title'] = ['$regex' => $searchQuery, '$options' => 'i']; // Case-insensitive search
            }
        }

        // Fetch properties with pagination (100 per page)
        $page = max(1, (int) $request->input('page', 1));
        $perPage = 100;
        $skip = ($page - 1) * $perPage;

        $properties = $this->propertyCollection->find($filter, ['limit' => $perPage, 'skip' => $skip])->toArray();
        $totalProperties = $this->propertyCollection->countDocuments($filter);

        // Fetch all data records
        $dataRecords = $this->dataCollection->find()->toArray();

        // Convert data records to an associative array for easy lookup
        $dataMap = [];
        foreach ($dataRecords as $data) {
            $dataMap[(string) $data['property_id']] = $data;
        }

        // Attach view_count and click_count to each property
        foreach ($properties as &$property) {
            $propertyId = (string) $property['_id'];
            $property['view_count'] = $dataMap[$propertyId]['view_count'] ?? 0;
            $property['click_count'] = $dataMap[$propertyId]['click_count'] ?? 0;
        }

        return view('admindashboard', [
            'properties' => $properties,
            'searchQuery' => $searchQuery,
            'totalPages' => ceil($totalProperties / $perPage),
            'currentPage' => $page
        ]);
    }

    public function delete($id)
    {
        // Delete property by its ID
        $this->propertyCollection->deleteOne(['_id' => new ObjectId($id)]);

        // Also delete related data from the 'data' collection
        $this->dataCollection->deleteOne(['property_id' => new ObjectId($id)]);

        return redirect()->route('admindashboard')->with('success', 'Property deleted successfully');
    }
}
