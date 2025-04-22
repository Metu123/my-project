<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MongoDB\Client;

class EmailController extends Controller
{
    public function sendMessage(Request $request, $property_id)
    {
        // Connect to MongoDB
        $client = new Client(env('DB_URI'));
        $db = $client->realestate;
        $collection = $db->property;

        // Find the property by ID
        $property = $collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($property_id)]);

        if (!$property || !isset($property['email'])) {
            return back()->with('error', 'Property not found or email missing.');
        }

        // Collect form data
        $data = [
            'name'    => $request->input('name'),
            'email'   => $request->input('email'),
            'phone'   => $request->input('phone'),
            'message' => $request->input('message'),
            'url'     => url()->previous(), // Page where form was submitted
        ];

        // Send email
        Mail::send('emails.property_inquiry', $data, function ($message) use ($property) {
            $message->to($property['email'])
                    ->subject('New Property Inquiry');
        });

        return back()->with('success', 'Message sent successfully!');
    }
}
