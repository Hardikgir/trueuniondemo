<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Handle a user subscribing to a new membership plan.
     *
     * @param  \App\Models\Membership  $membership
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Membership $membership)
    {
        $user = Auth::user();

        // Step 1: Deactivate any existing active memberships for this user.
        DB::table('user_memberships')
            ->where('user_id', $user->id)
            ->where('is_active', 1)
            ->update(['is_active' => 0]);

        // Step 2: Create the new active membership record.
        DB::table('user_memberships')->insert([
            'user_id' => $user->id,
            'membership_id' => $membership->id,
            'is_active' => 1,
            'visits_used' => 0, // Reset visit count
            'purchased_at' => now(),
            'expires_at' => now()->addDays(30), // Set expiry to 30 days from now
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Step 3: Redirect to the dashboard with a success message.
        return redirect()->route('dashboard')->with('status', "You have successfully subscribed to the {$membership->name} plan!");
    }
}
