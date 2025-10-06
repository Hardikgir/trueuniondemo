<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user\'s profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.edit-profile', compact('user'));
    }

    /**
     * Update the user\'s profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validate the incoming data
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'mobile_number' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'birth_day' => ['required', 'integer'],
            'birth_month' => ['required', 'integer'],
            'birth_year' => ['required', 'integer'],
            'highest_education_id' => ['nullable', 'integer', 'exists:highest_qualification_master,id'],
            'education_id' => ['nullable', 'integer', 'exists:education_master,id'],
            'occupation_id' => ['nullable', 'integer', 'exists:occupation_master,id'],
            'employed_in' => ['nullable', 'string', 'in:Business,Defence,Government,Not Employed in,Private,Others'],
            'country_id' => ['nullable', 'integer', 'exists:country_manage,id'],
            'state_id' => ['nullable', 'integer', 'exists:state_master,id'],
            'city_id' => ['nullable', 'integer', 'exists:city_master,id'],
        ]);

        // 2. Prepare the data for updating
        $updateData = $request->except(['_token', '_method', 'profile_image', 'birth_day', 'birth_month', 'birth_year', 'languages']);
        
        if ($request->has('languages')) {
            $updateData['languages_known'] = implode(',', $request->languages);
        } else {
            $updateData['languages_known'] = null;
        }

        // 3. Handle the file upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('profiles', 'public');
            $updateData['profile_image'] = $path;
        }
        
        // 4. Combine date fields
        $updateData['dob'] = Carbon::createFromDate($request->birth_year, $request->birth_month, $request->birth_day)->format('Y-m-d');

        // 5. Update the user\'s record
        $user->update($updateData);

        // --- LOG USER ACTIVITY ---
        // Add a new record to the user_activities table.
        DB::table('user_activities')->insert([
            'user_id' => $user->id,
            'activity' => 'Updated profile information.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('status', 'Profile updated successfully!');
    }

    /**
     * Get states for a given country.
     */
    public function getStates(Request $request)
    {
        $states = DB::table('state_master')
            ->where('country_id', $request->country_id)
            ->where('is_visible', 1)
            ->get();
        return response()->json($states);
    }

    /**
     * Get cities for a given state.
     */
    public function getCities(Request $request)
    {
        $cities = DB::table('city_master')
            ->where('state_id', $request->state_id)
            ->where('is_visible', 1)
            ->orderBy('city_master', 'ASC')
            ->get();
        return response()->json($cities);
    }
}
