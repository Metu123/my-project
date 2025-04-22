<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class DashboardController extends Controller
{
    protected $propertyCollection;
    protected $dataCollection;

    public function __construct()
    {
        $mongoClient = new Client(env('DB_URI'));
        $db = $mongoClient->realestate;

        $this->propertyCollection = $db->property;
        $this->dataCollection = $db->data;
    }

    public function index(Request $request)
    {
        $userSession = session('user');
        if (!$userSession) {
            return redirect('/')->with('error', 'Please log in to access the dashboard.');
        }

        // Fetch properties created by the logged-in user
        $properties = $this->propertyCollection->find(['created_by' => $userSession])->toArray();

        // Fetch all data records
        $dataRecords = $this->dataCollection->find()->toArray();

        // Initialize totals
        $totalProperties = count($properties);
        $totalViews = 0;
        $totalClicks = 0;

        // Convert data records to an associative array for easy lookup
        $dataMap = [];
        foreach ($dataRecords as $data) {
            $propertyId = (string) ($data['property_id'] instanceof ObjectId ? $data['property_id'] : new ObjectId($data['property_id']));
            if (!isset($dataMap[$propertyId])) {
                $dataMap[$propertyId] = ['views' => 0, 'click_count' => 0];
            }
            if (isset($data['views'])) {
                $dataMap[$propertyId]['views'] = $data['views'];
                $totalViews += $data['views'];
            }
            if (isset($data['click_count'])) {
                $dataMap[$propertyId]['click_count'] = $data['click_count'];
                $totalClicks += $data['click_count'];
            }
        }

        // Attach views and click_count to each property
        foreach ($properties as &$property) {
            $propertyId = (string) $property['_id'];
            $property['views'] = $dataMap[$propertyId]['views'] ?? 0;
            $property['click_count'] = $dataMap[$propertyId]['click_count'] ?? 0;
        }

        // Calculate Average Click-Through Rate (CTR) (CTR = Total Clicks / Total Views * 100)
        $averageCTR = ($totalViews > 0) ? round(($totalClicks / $totalViews) * 100, 2) : 0;

        return view('dashboard', compact('properties', 'totalProperties', 'totalViews', 'averageCTR'));
    }

    public function delete($id)
    {
        // Delete property by its ID
        $this->propertyCollection->deleteOne(['_id' => new ObjectId($id)]);

        // Also delete related data from the 'data' collection
        $this->dataCollection->deleteOne(['property_id' => new ObjectId($id)]);

        return redirect()->route('dashboard')->with('success', 'Property deleted successfully');
    }
}
