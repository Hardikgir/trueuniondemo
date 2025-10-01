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
            'cropped_image' => ['nullable', 'string'], // Validate the base64 string
            // ... other validation rules ...
            'terms' => ['accepted'],
        ]);

        $imagePath = null;
        // 2. Handle the cropped image upload
        if ($request->cropped_image) {
            $imageData = $request->cropped_image;
            // Decode the base64 string
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = str_replace(' ', '+', $image);
            // Generate a unique filename
            $imageName = time().'.png';
            // Save the file to the public storage disk
            File::put(storage_path('app/public/profiles/'.$imageName), base64_decode($image));
            // Set the path to be stored in the database
            $imagePath = 'profiles/'.$imageName;
        }

        // 3. Create the new user
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password),
            'profile_image' => $imagePath, // Save the image path
            // ... add all other fields from your form here ...
        ]);

        // 4. Log the new user in
        Auth::login($user);

        // 5. Redirect them to the dashboard
        return redirect()->route('dashboard');
    }
}
