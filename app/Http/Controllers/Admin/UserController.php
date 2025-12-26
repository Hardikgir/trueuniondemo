<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        // Get active membership with expiry
        $activeMembership = DB::table('user_memberships')
            ->where('user_memberships.user_id', $user->id)
            ->where('user_memberships.is_active', 1)
            ->join('memberships', 'user_memberships.membership_id', '=', 'memberships.id')
            ->select('user_memberships.*', 'memberships.name as membership_name', 'memberships.price', 'memberships.visits_allowed')
            ->first();

        // Calculate days remaining if membership exists
        $daysRemaining = null;
        if ($activeMembership) {
            // Free plans (price = 0) never expire, so don't calculate days remaining
            if ($activeMembership->price == 0) {
                $daysRemaining = null; // Free plan never expires
            } elseif ($activeMembership->expires_at) {
                $expiresAt = Carbon::parse($activeMembership->expires_at);
                $daysRemaining = (int) round(now()->diffInDays($expiresAt, false)); // Round to nearest integer
            } elseif ($activeMembership->purchased_at) {
                // If no expiry date for paid plans, calculate from purchased_at + 30 days
                $expiresAt = Carbon::parse($activeMembership->purchased_at)->addDays(30);
                $daysRemaining = (int) round(now()->diffInDays($expiresAt, false)); // Round to nearest integer
            }
        }

        // Get all membership history
        $membershipHistory = DB::table('user_memberships')
            ->where('user_memberships.user_id', $user->id)
            ->join('memberships', 'user_memberships.membership_id', '=', 'memberships.id')
            ->select('user_memberships.*', 'memberships.name as membership_name', 'memberships.price')
            ->orderBy('user_memberships.created_at', 'desc')
            ->get();

        // Get user activity history
        $activityHistory = DB::table('user_activities')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        // Get user update history from updated_at timestamps
        $updateHistory = [];
        if ($user->updated_at && $user->updated_at != $user->created_at) {
            $updateHistory[] = [
                'type' => 'Profile Updated',
                'description' => 'User profile information was updated',
                'date' => $user->updated_at,
            ];
        }

        // Add membership changes to history
        foreach ($membershipHistory as $membership) {
            $updateHistory[] = [
                'type' => 'Membership ' . ($membership->is_active ? 'Activated' : 'Deactivated'),
                'description' => $membership->membership_name . ' membership ' . ($membership->is_active ? 'activated' : 'deactivated'),
                'date' => $membership->is_active ? ($membership->created_at ?? $membership->purchased_at) : $membership->updated_at,
            ];
        }

        // Sort update history by date
        usort($updateHistory, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return view('admin.users.show', compact('user', 'activeMembership', 'daysRemaining', 'membershipHistory', 'activityHistory', 'updateHistory'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Get all available membership plans to populate the dropdown
        $memberships = Membership::all();

        // Get the user's current active subscription details
        $currentSubscription = DB::table('user_memberships')
            ->where('user_id', $user->id)
            ->where('is_active', 1)
            ->first();

        return view('admin.users.edit', compact('user', 'memberships', 'currentSubscription'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate all incoming data, including profile fields and management fields
        $rules = [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'admin'])],
            'membership_id' => ['nullable', 'exists:memberships,id'],
            'birth_day' => ['required', 'integer', 'min:1', 'max:31'],
            'birth_month' => ['required', 'integer', 'min:1', 'max:12'],
            'birth_year' => ['required', 'integer', 'min:1950', 'max:' . (date('Y') - 18)],
            'height' => ['required', 'string'],
            'marital_status' => ['required', 'string'],
            'highest_education' => ['required', 'string'],
            'education_details' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
        ];

        // Mobile number validation - only validate uniqueness if provided
        if ($request->filled('mobile_number')) {
            $rules['mobile_number'] = ['string', Rule::unique('users')->ignore($user->id)];
        } else {
            $rules['mobile_number'] = ['nullable', 'string'];
        }

        $request->validate($rules);

        // Prepare profile data for update
        $updateData = $request->except(['_token', '_method', 'membership_id', 'birth_day', 'birth_month', 'birth_year', 'languages']);
        
        // Combine date fields
        $updateData['dob'] = Carbon::createFromDate($request->birth_year, $request->birth_month, $request->birth_day)->format('Y-m-d');
        
        // Combine languages array into a string
        if ($request->has('languages')) {
            $updateData['languages_known'] = implode(',', $request->languages);
        } else {
            $updateData['languages_known'] = null;
        }
        
        // Update the user's main profile record
        $user->update($updateData);

        // --- Manage Subscription ---
        $newMembershipId = $request->input('membership_id');

        // Deactivate all existing memberships for this user first
        DB::table('user_memberships')
            ->where('user_id', $user->id)
            ->update(['is_active' => 0]);

        // If a new membership was selected (and it's not the "None" option)
        if ($newMembershipId) {
            // Create a new active subscription record
            DB::table('user_memberships')->insert([
                'user_id' => $user->id,
                'membership_id' => $newMembershipId,
                'is_active' => 1,
                'visits_used' => 0, // Reset visits count when admin assigns a new plan
                'purchased_at' => now(),
                'expires_at' => now()->addDays(30), // Set expiry to 30 days from now
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User profile and subscription updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

