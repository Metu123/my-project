<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\UTCDateTime;

class ReportController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $client = new Client(env('DB_URI'));
        $this->collection = $client->realestate->report;
    }

    // Show the report form
    public function showReportForm($property_id)
    {
        return view('report', compact('property_id'));
    }

    // Handle report submission
    public function submitReport(Request $request, $property_id)
    {
        $validated = $request->validate([
            'description' => 'required|string|min:10|max:1000',
        ]);

        $this->collection->insertOne([
            'property_id' => $property_id,
            'description' => $validated['description'],
            'created_at'  => new UTCDateTime(now()->timestamp * 1000),
        ]);

        return back()->with('success', 'Report submitted successfully.');
    }
}
