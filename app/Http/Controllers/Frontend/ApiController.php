<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Options;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getCity($provinceId)
    {
        return response()->json([
            'message' => 'Success Get City Data',
            'data' => Options::getCity(null, $provinceId)
        ]);
    }

    public function getDistrict($cityId)
    {
        return response()->json([
            'message' => 'Success Get City Data',
            'data' => Options::getDistrict(null, $cityId)
        ]);
    }
}
