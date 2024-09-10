<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

trait ApiCallHandle
{
    // public function mergedApiData($existingData)
    // {
    //     $existingData = $existingData->map(function ($data) {
    //         // api response
    //         $apiResponse = Http::get(env('API_URL') . $data->complain_id);

    //         if ($apiResponse->successful()) {
    //             // merged api data with existing data
    //             $apiData = $apiResponse->json();
    //             $data->api_data = $apiData;
    //         }
    //         return $data;
    //     });
    //     return $existingData;
    // }

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
}


    // $data = Cache::remember($cacheKey, 3600, function () use ($id) {
    //     $response = Http::get('https://api.example.com/data/' . $id);

    //     if ($response->failed()) {
    //         abort(500, 'Failed to retrieve data from API');
    //     }

    //     return $response->json();
    // });

    // return response()->json($data);