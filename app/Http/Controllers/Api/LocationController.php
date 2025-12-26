<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function getCountries()
    {
        $countries = DB::table('country_manage')
            ->where('status', 1)
            ->select('id', 'name', 'sortname', 'phone_code')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $countries,
        ]);
    }

    public function getStates(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|integer',
        ]);

        $states = DB::table('state_master')
            ->where('country_id', $validated['country_id'])
            ->where('is_visible', 1)
            ->select('id', 'name', 'country_id')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $states,
        ]);
    }

    public function getCities(Request $request)
    {
        $validated = $request->validate([
            'state_id' => 'required|integer',
        ]);

        $cities = DB::table('city_master')
            ->where('state_id', $validated['state_id'])
            ->where('is_visible', 1)
            ->select('id', 'name', 'state_id')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $cities,
        ]);
    }

    public function getEducations($qualificationId)
    {
        $educations = DB::table('education_master')
            ->where('highest_qualification_id', $qualificationId)
            ->where('status', 1)
            ->where('is_visible', 1)
            ->select('id', 'name', 'highest_qualification_id')
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $educations,
        ]);
    }
}

