@extends('layouts.admin')

@section('title', 'Edit Membership Plan')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Editing: {{ $membership->name }}</h3>
    </div>
    <form action="{{ route('admin.memberships.update', $membership->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Plan Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $membership->name) }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price (in ₹)</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $membership->price) }}" required>
            </div>
            <div class="form-group">
                <label for="visits_allowed">Profile Visits Allowed</label>
                <input type="number" class="form-control" id="visits_allowed" name="visits_allowed" value="{{ old('visits_allowed', $membership->visits_allowed) }}" required>
            </div>
            <div class="form-group">
                <label for="features">Features (one per line)</label>
                <textarea class="form-control" id="features" name="features" rows="4">{{ old('features', $membership->features) }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Plan</button>
            <a href="{{ route('admin.memberships.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

