<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    // ... other methods like home(), signup(), etc. ...

    public function home()
    {
        return view('pages.home');
    }

    public function signup()
    {
        return view('pages.signup');
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

    public function viewProfile($id)
    {
        $visitor = Auth::user();
        $profileUserId = $id;

        // Prevent users from viewing their own profile via the search page
        if ($visitor->id == $profileUserId) {
            return redirect()->route('dashboard')->with('status', 'You are viewing your own dashboard.');
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
        if ($user->dob) {
            $user->age = Carbon::parse($user->dob)->age;
        } else {
            $user->age = 'N/A';
        }

        // --- NEW: Fetch Suggested Profiles ---
        $oppositeGender = $visitor->gender === 'male' ? 'female' : 'male';
        $suggestedUsers = User::where('gender', $oppositeGender)
            ->where('id', '!=', $visitor->id)
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(3) // Get 3 random suggestions
            ->get();

        return view('pages.view-profile', compact('user', 'suggestedUsers'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
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

        // --- THIS IS THE NEW LOGIC ---
        // Get the user's recent activity history
        $activityHistory = DB::table('user_activities')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(10) // Get the last 10 activities
            ->get();
            
        return view('pages.dashboard', [
            'user' => $user,
            'membership' => $membership,
            'activityHistory' => $activityHistory // Pass the new data to the view
        ]);
    }
}

