<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeocodingController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = [];
        if ($request->q != '') {
            $data = app()->geo->getCoordinates($request->q);
        }

        if ($data == [] && $request->q_alt != '') {
            $data = app()->geo->getCoordinates($request->q_alt);
        }

        return $data;
    }
}
