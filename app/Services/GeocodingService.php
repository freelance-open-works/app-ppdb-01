<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public function __construct(private string $apiKey)
    {
    }

    public function getCoordinates($address)
    {
        $url = sprintf(
            'https://api.opencagedata.com/geocode/v1/json?q=%s&key=%s',
            urlencode($address),
            $this->apiKey
        );

        $cacheKey = self::class . $url;
        $cache = Cache::get($cacheKey);

        if ($cache != null) {
            return $cache;
        }

        $response = Http::get($url);
        $data = $response->json();

        info(self::class, [$url, $data]);

        if ($data && isset($data['results']) && count($data['results']) > 0) {
            $geometry = $data['results'][0]['geometry'];
            $data = [
                'latitude' => $geometry['lat'],
                'longitude' => $geometry['lng']
            ];

            Cache::set($cacheKey, $data, now()->addHours(12));

            return $data;
        }

        return [];
    }
}
