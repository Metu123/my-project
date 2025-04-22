<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;

class ClickTrackController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $mongoClient = new Client(env('DB_URI'));
        $this->collection = $mongoClient->realestate->data; // Select the `data` collection
    }

    public function trackClick($id)
    {
        // Check if property already exists
        $existing = $this->collection->findOne(['property_id' => $id]);

        if ($existing) {
            // Increment the click count
            $this->collection->updateOne(
                ['property_id' => $id],
                ['$inc' => ['click_count' => 1]]
            );
        } else {
            // Insert a new record
            $this->collection->insertOne([
                'property_id' => $id,
                'click_count' => 1
            ]);
        }

        // Build the redirect URL
        $url = env('NUXT_URL') . '/property/' . $id;

        // Return HTML with loader and JavaScript to break out of iframe and redirect
        return response()->make("
            <html>
                <head>
                    <title>Redirecting...</title>
                    <meta http-equiv='refresh' content='0;url={$url}'>
                    <style>
                        .spinner {
                            width: 50px;
                            height: 50px;
                            border: 5px solid #ccc;
                            border-top: 5px solid #333;
                            border-radius: 50%;
                            animation: spin 0.8s linear infinite;
                        }

                        @keyframes spin {
                            to { transform: rotate(360deg); }
                        }

                        #loader {
                            display: flex;
                            position: fixed;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: rgba(255,255,255,0.8);
                            z-index: 9999;
                            align-items: center;
                            justify-content: center;
                        }
                    </style>
                </head>
                <body>
                    <div id='loader'>
                        <div class='spinner'></div>
                    </div>
                    <script>
                        window.top.location.href = '{$url}';
                    </script>
                </body>
            </html>
        ", 200, ['Content-Type' => 'text/html']);
    }
}
