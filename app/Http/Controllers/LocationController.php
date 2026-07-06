<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\SthaniyaTaha;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistricts(Request $request,$province)
    {
        $districts = District::where('province_id', $province)->get();
        return response()->json($districts);
    }
    public function getSthaniyaTaha(Request $request,$district)
    {
        $municipalities = SthaniyaTaha::where('district_id', $district)->get();
        return response()->json($municipalities);
    }
}
