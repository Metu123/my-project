<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoDB;
use Illuminate\Pagination\LengthAwarePaginator;

class AgentController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = (new MongoDB)->realestate;
    }

    public function showAgentProfile(Request $request, $username)
    {
        // Check if the username exists in the users collection
        $user = $this->db->users->findOne(['name' => $username]);

        if (!$user) {
            return abort(404, 'User not found');
        }

        // Check if the username exists in the profile collection
        $profile = $this->db->profile->findOne(['username' => $username]);

        if (!$profile) {
            return view('agent', ['error' => 'Profile not found']);
        }

        // Fetch all properties created by the user
        $properties = iterator_to_array(
            $this->db->property->find(
                ['created_by' => $username],
                ['sort' => ['created_at' => -1]] // Sort by newest
            )
        );

        // Pagination
        $perPage = 9;
        $page = $request->query('page', 1);
        $offset = ($page - 1) * $perPage;
        $paginatedProperties = new LengthAwarePaginator(
            array_slice($properties, $offset, $perPage),
            count($properties),
            $perPage,
            $page,
            ['path' => url("/agent/$username")]
        );

        return view('agent', compact('profile', 'paginatedProperties'));
    }
}
