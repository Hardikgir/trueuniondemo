@extends('layouts.admin')

@section('title', 'Manage Memberships')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Membership Plans</h3>
        <div class="card-tools">
            <a href="{{ route('admin.memberships.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Plan
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price (₹)</th>
                    <th>Visits Allowed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($memberships as $membership)
                    <tr>
                        <td>{{ $membership->id }}</td>
                        <td>{{ $membership->name }}</td>
                        <td>{{ $membership->price }}</td>
                        <td>{{ $membership->visits_allowed }}</td>
                        <td>
                            <a href="{{ route('admin.memberships.edit', $membership->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.memberships.destroy', $membership->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this plan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No membership plans found. Please add one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

