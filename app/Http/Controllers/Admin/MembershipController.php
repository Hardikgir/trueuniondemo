<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership; // We will create this model
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return view('admin.memberships.index', compact('memberships'));
    }

    public function create()
    {
        return view('admin.memberships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'visits_allowed' => 'required|integer|min:0',
            'features' => 'nullable|string', // Validation for the new field
        ]);

        Membership::create($request->all()); // This will now include 'features'

        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan created successfully.');
    }

    public function edit(Membership $membership)
    {
        return view('admin.memberships.edit', compact('membership'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'visits_allowed' => 'required|integer|min:0',
            'features' => 'nullable|string', // Validation for the new field
        ]);

        $membership->update($request->all()); // This will now include 'features'

        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan updated successfully.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan deleted successfully.');
    }
}