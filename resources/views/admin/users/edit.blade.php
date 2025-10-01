@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->full_name)

@section('content')
<form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="row">
        {{-- Left Column --}}
        <div class="col-md-4">
            <!-- Profile Image Card -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://placehold.co/150x150/6c757d/ffffff?text=' . substr($user->full_name, 0, 1) }}"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                    <p class="text-muted text-center">{{ $user->role === 'admin' ? 'Administrator' : 'User' }}</p>
                </div>
            </div>

            <!-- Account Management Card -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Account Management</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">User Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="membership_id">Active Membership Plan</label>
                        <select class="form-control" id="membership_id" name="membership_id">
                            <option value="">None (No Active Plan)</option>
                            @foreach($memberships as $plan)
                                <option value="{{ $plan->id }}" {{ $currentSubscription && $currentSubscription->membership_id == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} ({{ $plan->visits_allowed }} visits)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if($currentSubscription)
                        <p class="text-muted">
                            Current Visits Used: {{ $currentSubscription->visits_used }}
                        </p>
                    @else
                        <p class="text-muted">This user has no active subscription.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-md-8">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="tab-basic-info-tab" data-toggle="pill" href="#tab-basic-info" role="tab">Basic Info</a></li>
                        <li class="nav-item"><a class="nav-link" id="tab-details-tab" data-toggle="pill" href="#tab-details" role="tab">Personal Details</a></li>
                        <li class="nav-item"><a class="nav-link" id="tab-professional-tab" data-toggle="pill" href="#tab-professional" role="tab">Professional</a></li>
                        <li class="nav-item"><a class="nav-link" id="tab-contact-tab" data-toggle="pill" href="#tab-contact" role="tab">Contact</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        {{-- Basic Info Tab --}}
                        <div class="tab-pane fade show active" id="tab-basic-info" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Full Name *</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender *</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Height *</label>
                                    <select name="height" class="form-control" required>
                                        <option>{{ old('height', $user->height) }}</option>
                                        {{-- Add other height options if needed --}}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Weight (kg)</label>
                                    <input type="number" name="weight" class="form-control" value="{{ old('weight', $user->weight) }}">
                                </div>
                            </div>
                             @php
                                $dob = $user->dob ? \Carbon\Carbon::parse($user->dob) : null;
                            @endphp
                            <div class="form-group">
                                <label>Date of Birth *</label>
                                <div class="row">
                                    <div class="col-4"><select name="birth_day" class="form-control" required>
                                        @for($i=1; $i<=31; $i++) <option value="{{$i}}" {{ $dob && $dob->day == $i ? 'selected' : '' }}>{{$i}}</option> @endfor
                                    </select></div>
                                    <div class="col-4"><select name="birth_month" class="form-control" required>
                                        @for($i=1; $i<=12; $i++) <option value="{{$i}}" {{ $dob && $dob->month == $i ? 'selected' : '' }}>{{ date('F', mktime(0,0,0,$i,10)) }}</option> @endfor
                                    </select></div>
                                    <div class="col-4"><select name="birth_year" class="form-control" required>
                                        @for($i=date('Y')-18; $i>=1950; $i--) <option value="{{$i}}" {{ $dob && $dob->year == $i ? 'selected' : '' }}>{{$i}}</option> @endfor
                                    </select></div>
                                </div>
                            </div>
                        </div>
                        {{-- Personal Details Tab --}}
                        <div class="tab-pane fade" id="tab-details" role="tabpanel">
                             <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Marital Status *</label>
                                    <select name="marital_status" class="form-control" required>
                                         <option>UnMarried</option>
                                         {{-- Add more options if needed --}}
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mother Tongue</label>
                                    <input type="text" name="mother_tongue" class="form-control" value="{{ old('mother_tongue', $user->mother_tongue) }}">
                                </div>
                             </div>
                        </div>
                        {{-- Professional Tab --}}
                        <div class="tab-pane fade" id="tab-professional" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Highest Education *</label>
                                    <input type="text" name="highest_education" class="form-control" value="{{ old('highest_education', $user->highest_education) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Education Details *</label>
                                    <input type="text" name="education_details" class="form-control" value="{{ old('education_details', $user->education_details) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Employed In</label>
                                    <input type="text" name="employed_in" class="form-control" value="{{ old('employed_in', $user->employed_in) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Occupation</label>
                                    <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $user->occupation) }}">
                                </div>
                            </div>
                        </div>
                        {{-- Contact Tab --}}
                        <div class="tab-pane fade" id="tab-contact" role="tabpanel">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile Number *</label>
                                    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Country *</label>
                                    <input type="text" name="country" class="form-control" value="{{ old('country', $user->country) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>State *</label>
                                    <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>City *</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
             <button type="submit" class="btn btn-primary">Save All Changes</button>
             <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</form>
@endsection

