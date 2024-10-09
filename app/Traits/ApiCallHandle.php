<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

trait ApiCallHandle
{
    public function apiData($existingData)
    {
        $complains = $this->complains();
        $existingData = $existingData->map(function($data) use ($complains){
            $complainData = $complains->firstWhere('cus_id',$data->complain_id);
        });
    }

    public function mergedApiData($existingData)
    {
        // Define a unique cache key based on the ID

        $existingData = $existingData->map(function ($existing) {
            $cacheKey = 'api_data_' . $existing->complain_id;
            $apiData = Cache::remember($cacheKey, 600, function () use ($existing) {
                $apiResponse = Http::get(env('API_URL') . $existing->complain_id);
                if ($apiResponse->successful()) {
                    return $apiResponse->json();
                }
            });
            $existing->api_data = $apiData;

            return $existing;
        });
        return $existingData;
    }

    public function callApi($ids)
    {
        // Prepare the array data to be sent to Laravel App 1
        $data = $ids;

        // Send POST request to Laravel App 1 (API Call Server)
        $response = Http::post('http://127.0.0.1:8000/api/complain/', ['id' => $data]);

        // Handle the response from Laravel App 1
        if ($response->successful()) {
            // Return the response from the API server
            return response()->json($response->json(), 200);
        }

        // Handle errors if the request to Laravel App 1 fails
        return response()->json(['error' => 'Unable to communicate with the API Call Server'], 500);
    }

    public function complains()
    {
        $response = Http::get(env('API_URL'));

        if ($response->successful()) {
            return collect($response->json()); // Convert API response to Laravel collection
        }

        return collect(); // Return empty collection if API fails
    }
}



    // $data = Cache::remember($cacheKey, 3600, function () use ($id) {
    //     $response = Http::get('https://api.example.com/data/' . $id);

    //     if ($response->failed()) {
    //         abort(500, 'Failed to retrieve data from API');
    //     }

    //     return $response->json();
    // });

    // return response()->json($data);