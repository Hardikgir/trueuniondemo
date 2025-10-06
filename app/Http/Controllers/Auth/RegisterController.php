<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // Add the File facade

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'profile_image' => ['nullable', 'string'], // base64 string
            'birth_day' => ['required', 'integer'],
            'birth_month' => ['required', 'integer'],
            'birth_year' => ['required', 'integer'],
            'gender' => ['required', 'in:male,female'],
            'highest_education_id' => ['nullable', 'integer', 'exists:highest_qualification_master,id'],
            'education_id' => ['nullable', 'integer', 'exists:education_master,id'],
            'occupation_id' => ['nullable', 'integer', 'exists:occupation_master,id'],
            'employed_in' => ['nullable', 'string', 'in:Business,Defence,Government,Not Employed in,Private,Others'],
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

        // 3. Create the new user
        $user = User::create(array_merge($request->except([
            'password', 'terms', 'profile_image', 'birth_day', 'birth_month', 'birth_year', '_token'
        ]), [
            'password' => Hash::make($request->password),
            'dob' => \Carbon\Carbon::createFromDate($request->birth_year, $request->birth_month, $request->birth_day)->format('Y-m-d'),
            'profile_image' => $imagePath,
        ]));

        // 4. Log the new user in
        Auth::login($user);

        // 5. Redirect them to the dashboard
        return redirect()->route('dashboard');
    }
}
