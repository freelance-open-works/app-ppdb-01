<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Default\Setting;
use Illuminate\Http\Request;

class DistanceController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['lat' => 'required', 'lng' => 'required']);

        $setting = explode('|', Setting::getByKey('school_coordinate'));

        return ['distance' => number_format(calculateDistance($setting[0], $setting[1], $request->lat, $request->lng), 2)];
    }
}
