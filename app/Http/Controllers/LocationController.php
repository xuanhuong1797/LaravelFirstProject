<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;

class LocationController extends Controller
{
    /**
     * Get all the districts
     *
     * @param Request $request
     * @return json
     */
    public function getDistrict(Request $request)
    {
        $query = $request->query('province_id');
        $districts = $query ? District::where('province_id', $query)->get() : District::all();

        return json_encode($districts, JSON_UNESCAPED_UNICODE);
    }

    /**
         * Get all the wards
         *
         * @param Request $request
         * @return json
         */
    public function getWard(Request $request)
    {
        $query = $request->query('district_id');
        $districts = $query ? Ward::where('district_id', $query)->get() : Ward::all();

        return json_encode($districts, JSON_UNESCAPED_UNICODE);
    }
}
