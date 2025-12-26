<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();

        $query = User::where('id', '!=', $user->id)
            ->where('gender', '!=', $user->gender);

        // Age filter
        if ($request->filled('age_from')) {
            $maxDob = Carbon::now()->subYears($request->age_from)->endOfDay();
            $query->where('dob', '<=', $maxDob);
        }

        if ($request->filled('age_to')) {
            $minDob = Carbon::now()->subYears($request->age_to + 1)->startOfDay();
            $query->where('dob', '>=', $minDob);
        }

        // Location filters
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        // Education filter
        if ($request->filled('education')) {
            $query->where('highest_education', $request->education);
        }

        // Occupation filter
        if ($request->filled('occupation')) {
            $query->where('occupation', 'like', '%' . $request->occupation . '%');
        }

        // Height filter
        if ($request->filled('height_min')) {
            $query->where('height', '>=', $request->height_min);
        }

        if ($request->filled('height_max')) {
            $query->where('height', '<=', $request->height_max);
        }

        // Marital status
        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        // Mother tongue
        if ($request->filled('mother_tongue')) {
            $query->where('mother_tongue', $request->mother_tongue);
        }

        // Caste
        if ($request->filled('caste')) {
            $query->where('caste', $request->caste);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'relevance');
        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'age_asc':
                $query->orderBy('dob', 'desc');
                break;
            case 'age_desc':
                $query->orderBy('dob', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $perPage = $request->get('per_page', 20);
        $results = $query->paginate($perPage);

        $formatted = $results->map(function($result) {
            return [
                'id' => $result->id,
                'full_name' => $result->full_name,
                'profile_image' => $result->profile_image ? asset('storage/' . $result->profile_image) : null,
                'age' => $result->dob ? Carbon::parse($result->dob)->age : null,
                'city' => $result->city,
                'state' => $result->state,
                'country' => $result->country,
                'occupation' => $result->occupation,
                'highest_education' => $result->highest_education,
                'height' => $result->height,
                'mother_tongue' => $result->mother_tongue,
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => [
                'results' => $formatted,
                'current_page' => $results->currentPage(),
                'total' => $results->total(),
                'per_page' => $results->perPage(),
                'last_page' => $results->lastPage(),
            ],
        ]);
    }
}

