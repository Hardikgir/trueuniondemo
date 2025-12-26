<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'string'], // base64 string
            'birth_day' => ['required', 'integer'],
            'birth_month' => ['required', 'integer'],
            'birth_year' => ['required', 'integer'],
            'gender' => ['required', 'in:male,female'],
            'caste' => ['nullable', 'string', 'max:255'],
            'mother_tongue' => ['nullable', 'string', 'max:255'],
            'raashi' => ['nullable', 'string', 'max:255'],
            'nakshtra' => ['nullable', 'string', 'max:255'],
            'highest_education_id' => ['nullable', 'integer', 'exists:highest_qualification_master,id'],
            'education_id' => ['nullable', 'integer', 'exists:education_master,id'],
            'occupation_id' => ['nullable', 'integer', 'exists:occupation_master,id'],
            'employed_in' => ['nullable', 'string', 'in:Business,Defence,Government,Not Employed,Private,Others'],
            'annual_income' => ['nullable', 'string', 'max:255'],
            'terms' => ['accepted'],
        ]);

        $imagePath = null;
        // 2. Handle the cropped image upload
        if ($request->profile_image) {
            $imageData = $request->profile_image;
            // Decode the base64 string
            $image = str_replace('data:image/jpeg;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            // Generate a unique filename
            $imageName = time().'.jpg';
            // Save the file to the public storage disk
            File::put(storage_path('app/public/profiles/'.$imageName), base64_decode($image));
            // Set the path to be stored in the database
            $imagePath = 'profiles/'.$imageName;
        }

        // 3. Get existing columns from users table
        $existingColumns = [];
        try {
            $columns = \Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM users");
            foreach ($columns as $column) {
                $existingColumns[] = $column->Field;
            }
        } catch (\Exception $e) {
            // If we can't check, use all fillable columns
            $existingColumns = (new \App\Models\User())->getFillable();
        }

        // 4. Prepare user data, filtering out non-existent columns
        $userData = $request->except([
            'password', 'password_confirmation', 'terms', 'profile_image', 'birth_day', 'birth_month', 'birth_year', '_token', 'profile_image_input', 'education_id', 'highest_education_id', 'occupation_id'
        ]);
        
        // Map IDs to names (database stores strings, not IDs)
        // Map highest_education_id to highest_education (name)
        if ($request->highest_education_id && in_array('highest_education', $existingColumns)) {
            $qualification = DB::table('highest_qualification_master')->where('id', $request->highest_education_id)->first();
            if ($qualification) {
                $userData['highest_education'] = $qualification->name;
            }
        }
        
        // Map education_id to education_details (name)
        if ($request->education_id && in_array('education_details', $existingColumns)) {
            $education = DB::table('education_master')->where('id', $request->education_id)->first();
            if ($education) {
                $userData['education_details'] = $education->name;
            }
        }
        
        // Map occupation_id to occupation (name)
        if ($request->occupation_id && in_array('occupation', $existingColumns)) {
            $occupation = DB::table('occupation_master')->where('id', $request->occupation_id)->first();
            if ($occupation) {
                $userData['occupation'] = $occupation->name;
            }
        }
        
        // Filter userData to only include columns that exist in the database
        $filteredUserData = [];
        foreach ($userData as $key => $value) {
            if (in_array($key, $existingColumns)) {
                $filteredUserData[$key] = $value;
            }
        }
        
        // Add password (always required)
        // Note: Laravel's 'hashed' cast in User model will automatically hash this
        $filteredUserData['password'] = $request->password;
        
        // Add dob if column exists
        if (in_array('dob', $existingColumns)) {
            $filteredUserData['dob'] = \Carbon\Carbon::createFromDate($request->birth_year, $request->birth_month, $request->birth_day)->format('Y-m-d');
        }
        
        // Add profile_image if column exists
        if (in_array('profile_image', $existingColumns) && $imagePath) {
            $filteredUserData['profile_image'] = $imagePath;
        }
        
        // Ensure role is set to 'user' for new registrations
        if (in_array('role', $existingColumns) && !isset($filteredUserData['role'])) {
            $filteredUserData['role'] = 'user';
        }
        
        // 5. Create the new user (free plan will be assigned automatically via model event)
        $user = User::create($filteredUserData);

        // 6. Log the new user in
        Auth::login($user);

        // 7. Redirect them to the dashboard
        return redirect()->route('dashboard');
    }
}
