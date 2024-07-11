<?php

if (!function_exists('splitPascalCase')) {
    function splitPascalCase($string)
    {
        $word = '';
        // Use a regular expression to insert a space before each capital letter except the first one
        $splitString = preg_replace('/(?<!^)([A-Z])/', ' $1', $string);
        foreach (explode(' ', $splitString) as $index => $s) {
            if ($index == 0) {
                $word .= $s;

                continue;
            }
            $word .= '-' . $s;
        }

        return $word;
    }
}

if (!function_exists('calculateDistance')) {
    function calculateDistance(
        float $latitudeFrom,
        float $longitudeFrom,
        float $latitudeTo,
        float $longitudeTo,
        string $unit = 'K'
    ): float {
        $earthRadius = [
            'K' => 6371,  // Earth's radius in kilometers
            'M' => 3959,  // Earth's radius in miles
            'N' => 3440,  // Earth's radius in nautical miles
        ];

        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) ** 2 + cos($latFrom) * cos($latTo) * sin($lonDelta / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius[$unit] * $c;

        return $distance;
    }
}
