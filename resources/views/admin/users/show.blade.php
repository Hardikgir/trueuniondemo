@extends('layouts.admin')

@section('title', 'View User: ' . $user->full_name)

@section('content')

<div class="row">
    <!-- User Information Card -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" 
                         src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/6c757d/ffffff?text=' . substr($user->full_name, 0, 1) }}" 
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Role</b> 
                        <span class="float-right">
                            @if($user->role == 'admin')
                                <span class="badge badge-success">Admin</span>
                            @else
                                <span class="badge badge-info">User</span>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item">
                        <b>Member Since</b> 
                        <span class="float-right">{{ $user->created_at->format('d M, Y') }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>Mobile</b> 
                        <span class="float-right">{{ $user->mobile_number ?? 'N/A' }}</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-block">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default btn-block">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Membership Card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Active Membership</h3>
            </div>
            <div class="card-body">
                @if($activeMembership)
                    <div class="text-center mb-3">
                        <h4 class="mb-0">{{ $activeMembership->membership_name }}</h4>
                        <p class="text-muted mb-0">₹{{ number_format($activeMembership->price) }}/month</p>
                    </div>
                    <hr>
                    <div class="mb-2">
                        <strong>Purchased:</strong> 
                        <span class="float-right">{{ \Carbon\Carbon::parse($activeMembership->purchased_at)->format('d M, Y') }}</span>
                    </div>
                    @if($activeMembership->expires_at)
                        <div class="mb-2">
                            <strong>Expires:</strong> 
                            <span class="float-right">{{ \Carbon\Carbon::parse($activeMembership->expires_at)->format('d M, Y') }}</span>
                        </div>
                    @endif
                    <div class="mb-2">
                        <strong>Visits Used:</strong> 
                        <span class="float-right">{{ $activeMembership->visits_used }} / {{ $activeMembership->visits_allowed }}</span>
                    </div>
                    @if($daysRemaining !== null)
                        <hr>
                        <div class="text-center">
                            @php
                                $daysRemainingRounded = (int) round($daysRemaining);
                            @endphp
                            <h3 class="mb-0 {{ $daysRemainingRounded < 0 ? 'text-danger' : ($daysRemainingRounded < 7 ? 'text-warning' : 'text-success') }}">
                                @if($daysRemainingRounded < 0)
                                    Expired {{ abs($daysRemainingRounded) }} day{{ abs($daysRemainingRounded) != 1 ? 's' : '' }} ago
                                @elseif($daysRemainingRounded == 0)
                                    Expires Today
                                @else
                                    {{ $daysRemainingRounded }} day{{ $daysRemainingRounded != 1 ? 's' : '' }} remaining
                                @endif
                            </h3>
                        </div>
                    @endif
                @else
                    <p class="text-muted text-center mb-0">No active membership</p>
                @endif
            </div>
        </div>
    </div>

    <!-- User Details Card -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#membership" data-toggle="tab">Membership History</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity History</a></li>
                    <li class="nav-item"><a class="nav-link" href="#updates" data-toggle="tab">Update History</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Profile Tab -->
                    <div class="active tab-pane" id="profile">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px;">Full Name</th>
                                <td>{{ $user->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td>{{ $user->mobile_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($user->gender ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Height</th>
                                <td>{{ $user->height ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>{{ $user->weight ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Marital Status</th>
                                <td>{{ ucfirst($user->marital_status ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <th>Highest Education</th>
                                <td>{{ $user->highest_education ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Education Details</th>
                                <td>{{ $user->education_details ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Occupation</th>
                                <td>{{ $user->occupation ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Annual Income</th>
                                <td>{{ $user->annual_income ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $user->country ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $user->state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $user->city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Mother Tongue</th>
                                <td>{{ $user->mother_tongue ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Languages Known</th>
                                <td>{{ $user->languages_known ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Caste</th>
                                <td>{{ $user->caste ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Diet</th>
                                <td>{{ ucfirst($user->diet ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <th>Account Created</th>
                                <td>{{ $user->created_at->format('d M, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $user->updated_at->format('d M, Y h:i A') }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Membership History Tab -->
                    <div class="tab-pane" id="membership">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Membership</th>
                                        <th>Price</th>
                                        <th>Purchased</th>
                                        <th>Expires</th>
                                        <th>Visits Used</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($membershipHistory as $membership)
                                        <tr>
                                            <td>{{ $membership->membership_name }}</td>
                                            <td>₹{{ number_format($membership->price) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($membership->purchased_at)->format('d M, Y') }}</td>
                                            <td>
                                                @if($membership->expires_at)
                                                    {{ \Carbon\Carbon::parse($membership->expires_at)->format('d M, Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($membership->purchased_at)->addDays(30)->format('d M, Y') }} <small class="text-muted">(estimated)</small>
                                                @endif
                                            </td>
                                            <td>{{ $membership->visits_used }}</td>
                                            <td>
                                                @if($membership->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No membership history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Activity History Tab -->
                    <div class="tab-pane" id="activity">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activityHistory as $activity)
                                        <tr>
                                            <td>{{ $activity->activity }}</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('d M, Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">No activity history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Update History Tab -->
                    <div class="tab-pane" id="updates">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($updateHistory as $update)
                                        <tr>
                                            <td>{{ $update['type'] }}</td>
                                            <td>{{ $update['description'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($update['date'])->format('d M, Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No update history found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

