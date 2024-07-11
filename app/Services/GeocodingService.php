<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class GeocodingService
{
    private $client;
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->client = new Http();
        $this->apiKey = $apiKey;
    }

    public function getCoordinates($address)
    {
        $url = sprintf(
            'https://api.opencagedata.com/geocode/v1/json?q=%s&key=%s',
            urlencode($address),
            $this->apiKey
        );

        $response = $this->client->get($url);
        $data = $response->json();

        if ($data && isset($data['results']) && count($data['results']) > 0) {
            $geometry = $data['results'][0]['geometry'];
            return [
                'latitude' => $geometry['lat'],
                'longitude' => $geometry['lng']
            ];
        }

        return null;
    }
}
