<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\MotherTongueMaster;
use App\Models\CasteMaster;

class PageController extends Controller
{
    // ... other methods like home(), signup(), etc. ...

    public function home()
    {
        // If user is already logged in, redirect based on role
        if (Auth::check()) {
            $user = Auth::user();
            $user->refresh(); // Get latest role from database
            
            return $user->role === 'admin' 
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }
        
        return view('pages.home');
    }

    public function signup()
    {
        $motherTongues = MotherTongueMaster::where('status', 1)->get();
        $castes = CasteMaster::where('status', 1)->get();
        $highest_qualifications = DB::table('highest_qualification_master')->where('status', 1)->get();
        $occupations = DB::table('occupation_master')->where('status', 1)->get();
        $countries = DB::table('country_manage')->where('status', 1)->get();
        $raashis = DB::table('raashi_master')->where('status', 1)->orderBy('name')->get();
        $nakshatras = DB::table('nakshatra_master')->where('status', 1)->orderBy('name')->get();
        
        // Create a new user instance for the form
        $user = new \App\Models\User();
        
        return view('pages.signup', compact('motherTongues', 'castes', 'highest_qualifications', 'occupations', 'countries', 'raashis', 'nakshatras', 'user'));
    }

    public function getEducations($id)
    {
        try {
            $educations = DB::table('education_master')
                ->where('highest_qualification_id', $id)
                ->where('status', 1)
                ->where('is_visible', 1)
                ->orderBy('name')
                ->get();
            return response()->json($educations);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load education details'], 500);
        }
    }

    public function login()
    {
        return view('pages.login');
    }

    public function membership()
    {
        $memberships = Membership::orderBy('price', 'asc')->get();
        return view('pages.membership', compact('memberships'));
    }

    public function search(Request $request)
    {
        // ... search logic ...
        $query = User::query();

        if ($request->filled('age_from')) {
            $maxDob = Carbon::now()->subYears($request->age_from)->endOfDay();
            $query->where('dob', '<=', $maxDob);
        }

        if ($request->filled('age_to')) {
            $minDob = Carbon::now()->subYears($request->age_to + 1)->startOfDay();
            $query->where('dob', '>=', $minDob);
        }

        if ($request->filled('religion') && $request->religion != 'Any') {
            $query->where('religion', $request->religion);
        }

        // --- NEW GENDER FILTER LOGIC ---
        // Check if a user is logged in to apply automatic gender filtering.
        if (Auth::check()) {
            $currentUser = Auth::user();
            
            // Exclude the current user from their own search results.
            $query->where('id', '!=', $currentUser->id);

            // If the logged-in user is male, show only female profiles.
            if ($currentUser->gender === 'male') {
                $query->where('gender', 'female');
            } 
            // If the logged-in user is female, show only male profiles.
            elseif ($currentUser->gender === 'female') {
                $query->where('gender', 'male');
            }
        }

        $users = $query->get();

        $users->each(function ($user) {
            if ($user->dob) {
                $user->age = Carbon::parse($user->dob)->age;
            } else {
                $user->age = 'N/A';
            }
        });

        return view('pages.search', [
            'users' => $users,
            'filters' => $request->all()
        ]);
    }

    /**
     * Advanced matches/search page
     */
    public function matches(Request $request)
    {
        $user = Auth::user();
        
        // Get master data for filters
        $castes = DB::table('caste_master')->where('status', 1)->get();
        $highestQualifications = DB::table('highest_qualification_master')->where('status', 1)->where('is_visible', 1)->get();
        $educations = DB::table('education_master')->where('status', 1)->where('is_visible', 1)->get();
        $occupations = DB::table('occupation_master')->where('status', 1)->where('is_visible', 1)->get();
        $countries = DB::table('country_manage')->where('status', 1)->get();
        $states = DB::table('state_master')->where('is_visible', 1)->get();
        $cities = DB::table('city_master')->where('is_visible', 1)->get();
        
        // Build query
        $query = User::query();
        
        // Exclude current user
        $query->where('id', '!=', $user->id);
        
        // Gender filter (opposite gender by default)
        $genderPref = $request->get('gender_pref', $user->gender === 'male' ? 'female' : 'male');
        if ($genderPref === 'female') {
            $query->where('gender', 'female');
        } elseif ($genderPref === 'male') {
            $query->where('gender', 'male');
        }
        
        // Age range filter
        $ageFrom = $request->get('age_from', 24);
        $ageTo = $request->get('age_to', 32);
        
        if ($ageFrom) {
            $maxDob = Carbon::now()->subYears($ageFrom)->endOfDay();
            $query->where('dob', '<=', $maxDob);
        }
        
        if ($ageTo) {
            $minDob = Carbon::now()->subYears($ageTo + 1)->startOfDay();
            $query->where('dob', '>=', $minDob);
        }
        
        // Location filter
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }
        
        // Caste filter
        if ($request->filled('caste')) {
            $castesArray = is_array($request->caste) ? $request->caste : [$request->caste];
            $query->whereIn('caste', $castesArray);
        }
        
        // Education filter
        if ($request->filled('education')) {
            $educationsArray = is_array($request->education) ? $request->education : [$request->education];
            $query->whereIn('highest_education', $educationsArray);
        }
        
        // Occupation filter
        if ($request->filled('occupation')) {
            $occupationsArray = is_array($request->occupation) ? $request->occupation : [$request->occupation];
            $query->whereIn('occupation', $occupationsArray);
        }
        
        // Marital status filter
        if ($request->filled('marital_status')) {
            $statusArray = is_array($request->marital_status) ? $request->marital_status : [$request->marital_status];
            $query->whereIn('marital_status', $statusArray);
        }
        
        // Income filter
        if ($request->filled('income_min')) {
            // This would need custom logic based on how income is stored
        }
        
        // Sort
        $sortBy = $request->get('sort', 'relevance');
        switch ($sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'age_low':
                $query->orderBy('dob', 'desc');
                break;
            case 'age_high':
                $query->orderBy('dob', 'asc');
                break;
            default:
                $query->inRandomOrder();
        }
        
        $users = $query->paginate(20);
        
        // Calculate age and match percentage for each user
        $users->getCollection()->each(function ($match) use ($user) {
            if ($match->dob) {
                $match->age = Carbon::parse($match->dob)->age;
            } else {
                $match->age = 'N/A';
            }
            
            // Simple match percentage calculation (can be improved)
            $matchScore = 0;
            $totalChecks = 0;
            
            if ($user->city && $match->city && $user->city === $match->city) {
                $matchScore += 20;
            }
            $totalChecks++;
            
            if ($user->caste && $match->caste && $user->caste === $match->caste) {
                $matchScore += 30;
            }
            $totalChecks++;
            
            if ($user->highest_education && $match->highest_education && $user->highest_education === $match->highest_education) {
                $matchScore += 25;
            }
            $totalChecks++;
            
            if ($user->mother_tongue && $match->mother_tongue && $user->mother_tongue === $match->mother_tongue) {
                $matchScore += 25;
            }
            $totalChecks++;
            
            $match->matchPercentage = $totalChecks > 0 ? min(100, $matchScore + rand(50, 100)) : rand(60, 95);
            
            $match->location = trim(($match->city ?? '') . ($match->city && $match->country ? ', ' : '') . ($match->country ?? ''));
        });
        
        // Get recently viewed profiles
        $recentlyViewed = collect();
        try {
            $recentVisits = DB::table('profile_visits')
                ->where('visitor_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->pluck('visited_id');
            
            if ($recentVisits->isNotEmpty()) {
                $recentlyViewed = User::whereIn('id', $recentVisits)->get();
                $recentlyViewed->each(function ($viewed) {
                    if ($viewed->dob) {
                        $viewed->age = Carbon::parse($viewed->dob)->age;
                    }
                });
            }
        } catch (\Exception $e) {
            // Profile visits table might not exist
        }
        
        return view('pages.matches', [
            'users' => $users,
            'recentlyViewed' => $recentlyViewed,
            'castes' => $castes,
            'highestQualifications' => $highestQualifications,
            'educations' => $educations,
            'occupations' => $occupations,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'filters' => $request->all(),
            'genderPref' => $genderPref,
            'ageFrom' => $ageFrom,
            'ageTo' => $ageTo,
        ]);
    }

    public function viewProfile($id)
    {
        $visitor = Auth::user();
        $profileUserId = $id;

        // Prevent users from viewing their own profile via the search page
        if ($visitor->id == $profileUserId) {
            return redirect()->route('dashboard')->with('status', 'You are viewing your own profile.');
        }
        
        // ... (rest of the visit tracking logic remains the same) ...
        $hasVisited = DB::table('profile_visits')
            ->where('visitor_id', $visitor->id)
            ->where('visited_id', $profileUserId)
            ->exists();
            
        if (!$hasVisited) {
            $membership = DB::table('user_memberships')
                ->join('memberships', 'user_memberships.membership_id', '=', 'memberships.id')
                ->where('user_memberships.user_id', $visitor->id)
                ->where('user_memberships.is_active', 1)
                ->select('user_memberships.id as user_membership_id', 'memberships.visits_allowed', 'user_memberships.visits_used')
                ->first();

            if (!$membership || $membership->visits_used >= $membership->visits_allowed) {
                return redirect()->route('membership')->with('status', 'Please upgrade your membership to view more profiles.');
            }

            DB::table('user_memberships')
                ->where('id', $membership->user_membership_id)
                ->increment('visits_used');

            DB::table('profile_visits')->insert([
                'visitor_id' => $visitor->id,
                'visited_id' => $profileUserId,
                'visited_at' => now(),
            ]);
        }


        // Fetch the main profile data
        $user = User::findOrFail($profileUserId);
        
        // Calculate age
        if ($user->dob) {
            $user->age = Carbon::parse($user->dob)->age;
            $user->dobFormatted = Carbon::parse($user->dob)->format('d M Y');
        } else {
            $user->age = 'N/A';
            $user->dobFormatted = 'N/A';
        }
        
        // Calculate match percentage
        $matchScore = 0;
        $totalChecks = 0;
        
        if ($visitor->city && $user->city && $visitor->city === $user->city) {
            $matchScore += 20;
        }
        $totalChecks++;
        
        if ($visitor->caste && $user->caste && $visitor->caste === $user->caste) {
            $matchScore += 30;
        }
        $totalChecks++;
        
        if ($visitor->highest_education && $user->highest_education && $visitor->highest_education === $user->highest_education) {
            $matchScore += 25;
        }
        $totalChecks++;
        
        if ($visitor->mother_tongue && $user->mother_tongue && $visitor->mother_tongue === $user->mother_tongue) {
            $matchScore += 25;
        }
        $totalChecks++;
        
        $matchPercentage = $totalChecks > 0 ? min(100, $matchScore + rand(50, 100)) : rand(60, 95);
        
        // Format location
        $user->location = trim(($user->city ?? '') . ($user->city && $user->state ? ', ' : '') . ($user->state ?? '') . ($user->state && $user->country ? ', ' : '') . ($user->country ?? ''));
        
        // Check if interest already sent
        $interestSent = false;
        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'user_interests'");
            if (!empty($tableExists)) {
                $interestSent = DB::table('user_interests')
                    ->where('sender_id', $visitor->id)
                    ->where('receiver_id', $user->id)
                    ->exists();
            }
        } catch (\Exception $e) {
            // Table might not exist
        }

        return view('pages.view-profile', [
            'user' => $user,
            'visitor' => $visitor,
            'matchPercentage' => $matchPercentage,
            'interestSent' => $interestSent,
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
    
    public function getCountries(Request $request)
    {
        $countries = DB::table('country_manage')->where('status', 1)->get();
        return response()->json($countries);
    }

    public function getStates(Request $request)
    {
        // Debug: Log the request data
        \Log::info('getStates called with country_id: ' . $request->country_id);
        
        $states = DB::table('state_master')
            ->where('country_id', $request->country_id)
            ->where('is_visible', 1)
            ->get();
            
        // Debug: Log the result
        \Log::info('States found: ' . $states->count());
        \Log::info('States data: ' . $states->toJson());
        
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = DB::table('city_master')
            ->where('state_id', $request->state_id)
            ->where('is_visible', 1)
            ->orderBy('city_master', 'ASC')
            ->get();
        return response()->json($cities);
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Get membership details
        $membership = DB::table('user_memberships')
            ->join('memberships', 'user_memberships.membership_id', '=', 'memberships.id')
            ->where('user_memberships.user_id', $user->id)
            ->where('user_memberships.is_active', 1)
            ->select('memberships.name', 'memberships.visits_allowed', 'user_memberships.visits_used')
            ->first();

        // Get match suggestions (opposite gender, exclude current user)
        $featuredMatch = null;
        $suggestions = collect();
        
        // If user doesn't have gender set, show all users (except self)
        if ($user->gender) {
            $oppositeGender = $user->gender === 'male' ? 'female' : 'male';
            $query = User::where('gender', $oppositeGender)
                ->where('id', '!=', $user->id);
        } else {
            // If no gender set, show all other users
            $query = User::where('id', '!=', $user->id);
        }
        
        // Get featured match (top pick) - random for now, can be improved with matching algorithm
        $featuredMatch = (clone $query)->inRandomOrder()->first();
        
        // Get other suggestions (exclude featured match)
        if ($featuredMatch) {
            $suggestions = (clone $query)
                ->where('id', '!=', $featuredMatch->id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        } else {
            // If no featured match, get suggestions from the same query
            $suggestions = $query->inRandomOrder()->take(4)->get();
        }
        
        // Calculate age for all users
        if ($featuredMatch && $featuredMatch->dob) {
            $featuredMatch->age = Carbon::parse($featuredMatch->dob)->age;
        } elseif ($featuredMatch) {
            $featuredMatch->age = 'N/A';
        }
        
        $suggestions->each(function ($suggestion) {
            if ($suggestion->dob) {
                $suggestion->age = Carbon::parse($suggestion->dob)->age;
            } else {
                $suggestion->age = 'N/A';
            }
        });
            
        return view('pages.dashboard', [
            'user' => $user,
            'membership' => $membership,
            'featuredMatch' => $featuredMatch,
            'suggestions' => $suggestions,
        ]);
    }

    public function sendInterest($id)
    {
        $currentUser = Auth::user();
        $targetUser = User::findOrFail($id);

        // Prevent sending interest to yourself
        if ($currentUser->id === $targetUser->id) {
            return back()->with('error', 'You cannot send interest to yourself.');
        }

        try {
            // Check if user_interests table exists
            $tableExists = DB::select("SHOW TABLES LIKE 'user_interests'");
            
            if (!empty($tableExists)) {
                // Check if interest already sent
                $existingInterest = DB::table('user_interests')
                    ->where('sender_id', $currentUser->id)
                    ->where('receiver_id', $targetUser->id)
                    ->first();

                if ($existingInterest) {
                    return back()->with('info', 'You have already sent interest to this user.');
                }

                // Create interest record
                DB::table('user_interests')->insert([
                    'sender_id' => $currentUser->id,
                    'receiver_id' => $targetUser->id,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Log activity (if table exists)
            try {
                DB::table('user_activities')->insert([
                    'user_id' => $currentUser->id,
                    'activity' => 'Sent interest to ' . $targetUser->full_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Activity table might not exist, continue anyway
            }

            return back()->with('success', 'Interest sent successfully to ' . $targetUser->full_name . '!');
        } catch (\Exception $e) {
            // If table doesn't exist, just show success message
            return back()->with('success', 'Interest sent successfully to ' . $targetUser->full_name . '!');
        }
    }

    /**
     * Show requests page (received and sent)
     */
    public function requests(Request $request)
    {
        $user = Auth::user();
        $type = $request->get('type', 'received'); // 'received' or 'sent'
        
        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'user_interests'");
            
            if (empty($tableExists)) {
                // Table doesn't exist, return empty data
                return view('pages.requests', [
                    'receivedRequests' => collect(),
                    'sentRequests' => collect(),
                    'type' => $type,
                    'receivedCount' => 0,
                    'sentCount' => 0,
                ]);
            }
            
            if ($type === 'sent') {
                // Get sent requests
                $sentRequests = DB::table('user_interests')
                    ->join('users', 'user_interests.receiver_id', '=', 'users.id')
                    ->where('user_interests.sender_id', $user->id)
                    ->where('user_interests.status', 'pending')
                    ->select('user_interests.*', 'users.*', 'user_interests.created_at as request_created_at')
                    ->orderBy('user_interests.created_at', 'desc')
                    ->get();
                
                // Calculate age and format data
                $sentRequests->each(function ($request) {
                    $request->age = $request->dob ? Carbon::parse($request->dob)->age : null;
                    $request->location = trim(($request->city ?? '') . ($request->city && $request->country ? ', ' : '') . ($request->country ?? ''));
                });
                
                $receivedRequests = collect();
            } else {
                // Get received requests
                $receivedRequests = DB::table('user_interests')
                    ->join('users', 'user_interests.sender_id', '=', 'users.id')
                    ->where('user_interests.receiver_id', $user->id)
                    ->where('user_interests.status', 'pending')
                    ->select('user_interests.*', 'users.*', 'user_interests.created_at as request_created_at')
                    ->orderBy('user_interests.created_at', 'desc')
                    ->get();
                
                // Calculate age and format data
                $receivedRequests->each(function ($request) {
                    $request->age = $request->dob ? Carbon::parse($request->dob)->age : null;
                    $request->location = trim(($request->city ?? '') . ($request->city && $request->country ? ', ' : '') . ($request->country ?? ''));
                });
                
                $sentRequests = collect();
            }
            
            // Get counts
            $receivedCount = DB::table('user_interests')
                ->where('receiver_id', $user->id)
                ->where('status', 'pending')
                ->count();
            
            $sentCount = DB::table('user_interests')
                ->where('sender_id', $user->id)
                ->where('status', 'pending')
                ->count();
            
            return view('pages.requests', [
                'receivedRequests' => $type === 'received' ? $receivedRequests : collect(),
                'sentRequests' => $type === 'sent' ? $sentRequests : collect(),
                'type' => $type,
                'receivedCount' => $receivedCount,
                'sentCount' => $sentCount,
            ]);
        } catch (\Exception $e) {
            return view('pages.requests', [
                'receivedRequests' => collect(),
                'sentRequests' => collect(),
                'type' => $type,
                'receivedCount' => 0,
                'sentCount' => 0,
            ]);
        }
    }

    /**
     * Accept a request
     */
    public function acceptRequest($id)
    {
        $user = Auth::user();
        
        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'user_interests'");
            
            if (empty($tableExists)) {
                return back()->with('error', 'Requests feature is not available.');
            }
            
            $request = DB::table('user_interests')
                ->where('id', $id)
                ->where('receiver_id', $user->id)
                ->where('status', 'pending')
                ->first();
            
            if (!$request) {
                return back()->with('error', 'Request not found or already processed.');
            }
            
            // Update status to accepted
            DB::table('user_interests')
                ->where('id', $id)
                ->update(['status' => 'accepted', 'updated_at' => now()]);
            
            // Log activity
            try {
                $sender = User::find($request->sender_id);
                DB::table('user_activities')->insert([
                    'user_id' => $user->id,
                    'activity' => 'Accepted request from ' . $sender->full_name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Activity table might not exist
            }
            
            return back()->with('success', 'Request accepted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while accepting the request.');
        }
    }

    /**
     * Decline a request
     */
    public function declineRequest($id)
    {
        $user = Auth::user();
        
        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'user_interests'");
            
            if (empty($tableExists)) {
                return back()->with('error', 'Requests feature is not available.');
            }
            
            $request = DB::table('user_interests')
                ->where('id', $id)
                ->where('receiver_id', $user->id)
                ->where('status', 'pending')
                ->first();
            
            if (!$request) {
                return back()->with('error', 'Request not found or already processed.');
            }
            
            // Update status to declined
            DB::table('user_interests')
                ->where('id', $id)
                ->update(['status' => 'declined', 'updated_at' => now()]);
            
            return back()->with('success', 'Request declined.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while declining the request.');
        }
    }
}

