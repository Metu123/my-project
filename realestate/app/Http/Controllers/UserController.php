<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class UserController extends Controller
{
    private $collection;

    public function __construct()
    {

        $this->collection = (new Client(env('DB_URI')))->realestate->users;
    }

    // Display Users with Search and Pagination
    public function index(Request $request)
    {
        if (!session()->has('admin')) {
            return redirect('/admin/login')->with('error', 'You must be logged in as admin to access this page.');
        }
        
        $search = $request->input('search', '');
        $page = max(1, intval($request->input('page', 1)));
        $limit = 100;
        $skip = ($page - 1) * $limit;

        // Search users by name
        $query = [];
        if (!empty($search)) {
            $query = ['name' => ['$regex' => $search, '$options' => 'i']];
        }

        // Fetch users from MongoDB
        $users = $this->collection->find($query, [
            'limit' => $limit,
            'skip' => $skip
        ])->toArray();

        // Count total users for pagination
        $totalUsers = $this->collection->countDocuments($query);
        $totalPages = ceil($totalUsers / $limit);

        return view('users', compact('users', 'search', 'page', 'totalPages'));
    }

    // Delete User
    public function destroy($id)
    {
        $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
