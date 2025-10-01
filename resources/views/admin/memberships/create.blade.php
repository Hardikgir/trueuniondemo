@extends('layouts.admin')

@section('title', 'Add New Membership Plan')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Plan Details</h3>
    </div>
    <form action="{{ route('admin.memberships.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Plan Name (e.g., Gold, Silver)</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter plan name" required>
            </div>
            <div class="form-group">
                <label for="price">Price (in ₹)</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="e.g., 750" required>
            </div>
            <div class="form-group">
                <label for="visits_allowed">Profile Visits Allowed</label>
                <input type="number" class="form-control" id="visits_allowed" name="visits_allowed" placeholder="e.g., 55" required>
            </div>
            <div class="form-group">
                <label for="features">Features (one per line)</label>
                <textarea class="form-control" id="features" name="features" rows="4" placeholder="e.g.,&#10;Feature One&#10;Feature Two"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save Plan</button>
            <a href="{{ route('admin.memberships.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

