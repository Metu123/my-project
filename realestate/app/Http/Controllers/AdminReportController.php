<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class AdminReportController extends Controller
{
    protected $db;

    public function __construct()
    {
        // Retrieve MongoDB credentials from .env
        $mongoUri = env('DB_URI', 'mongodb://admin:12345678@127.0.0.1:27017/realestate?authSource=admin');

        // Connect to MongoDB with authentication
        $this->db = (new Client($mongoUri))->realestate;
    }

    // Show the report table with pagination
    public function showReportTable(Request $request)
    {
        if (!session()->has('admin')) {
            return redirect('/admin/login')->with('error', 'You must be logged in as admin to access this page.');
        }

        $perPage = 10; // Number of reports per page
        $page = $request->get('page', 1); // Get current page number

        // Aggregate reports by property_id, count occurrences, and collect descriptions
        $reports = $this->db->report->aggregate([
            [
                '$group' => [
                    '_id' => '$property_id',
                    'report_count' => ['$sum' => 1],
                    'descriptions' => ['$push' => '$description'], // Collect all descriptions
                ],
            ],
            [
                '$sort' => ['report_count' => -1], // Sort by highest report count
            ],
        ]);

        $reportsArray = iterator_to_array($reports); // Convert to array

        $total = count($reportsArray); // Total number of reports
        $reports = array_slice($reportsArray, ($page - 1) * $perPage, $perPage); // Apply manual pagination

        return view('report_table', [
            'reports' => $reports,
            'total' => $total,
            'perPage' => $perPage,
            'currentPage' => $page
        ]);
    }

    // Delete a report by property_id
    public function deleteReport($id)
    {
        if (!session()->has('admin')) {
            return redirect('/admin/login')->with('error', 'Unauthorized access.');
        }

        $this->db->report->deleteMany(['property_id' => $id]); // Delete all reports for the given property ID

        return redirect()->route('admin.reports')->with('success', 'Report deleted successfully.');
    }
}
