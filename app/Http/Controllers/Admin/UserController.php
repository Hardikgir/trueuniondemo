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
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'admin'])],
            'membership_id' => ['nullable', 'exists:memberships,id'],
            // Add validation for other essential fields from the partial
            'birth_day' => ['required', 'integer'],
            'birth_month' => ['required', 'integer'],
            'birth_year' => ['required', 'integer'],
            'height' => ['required', 'string'],
            'marital_status' => ['required', 'string'],
            'highest_education' => ['required', 'string'],
            'education_details' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'city' => ['required', 'string'],
            'mobile_number' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
        ]);

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

