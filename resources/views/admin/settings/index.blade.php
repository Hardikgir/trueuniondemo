@extends('layouts.admin')

@section('title', 'Settings Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Settings Management</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Language Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-language fa-3x mb-3"></i>
                                    <h5 class="card-title">Language Management</h5>
                                    <p class="card-text">Manage mother tongue options</p>
                                    <a href="{{ route('admin.settings.language') }}" class="btn btn-light">Manage Languages</a>
                                </div>
                            </div>
                        </div>

                        <!-- Caste Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x mb-3"></i>
                                    <h5 class="card-title">Caste Management</h5>
                                    <p class="card-text">Manage caste categories</p>
                                    <a href="{{ route('admin.settings.caste') }}" class="btn btn-light">Manage Castes</a>
                                </div>
                            </div>
                        </div>

                        <!-- Highest Education Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                    <h5 class="card-title">Highest Education</h5>
                                    <p class="card-text">Manage highest qualification levels</p>
                                    <a href="{{ route('admin.settings.highest-education') }}" class="btn btn-light">Manage Education</a>
                                </div>
                            </div>
                        </div>

                        <!-- Education Details Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-book fa-3x mb-3"></i>
                                    <h5 class="card-title">Education Details</h5>
                                    <p class="card-text">Manage specific education details</p>
                                    <a href="{{ route('admin.settings.education-details') }}" class="btn btn-light">Manage Details</a>
                                </div>
                            </div>
                        </div>

                        <!-- Occupation Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-briefcase fa-3x mb-3"></i>
                                    <h5 class="card-title">Occupation Management</h5>
                                    <p class="card-text">Manage occupation categories</p>
                                    <a href="{{ route('admin.settings.occupation') }}" class="btn btn-light">Manage Occupations</a>
                                </div>
                            </div>
                        </div>

                        <!-- Country Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-globe fa-3x mb-3"></i>
                                    <h5 class="card-title">Country Management</h5>
                                    <p class="card-text">Manage countries</p>
                                    <a href="{{ route('admin.settings.country') }}" class="btn btn-light">Manage Countries</a>
                                </div>
                            </div>
                        </div>

                        <!-- State Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-dark text-white">
                                <div class="card-body text-center">
                                    <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                                    <h5 class="card-title">State Management</h5>
                                    <p class="card-text">Manage states/provinces</p>
                                    <a href="{{ route('admin.settings.state') }}" class="btn btn-light">Manage States</a>
                                </div>
                            </div>
                        </div>

                        <!-- City Management -->
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light text-dark">
                                <div class="card-body text-center">
                                    <i class="fas fa-city fa-3x mb-3"></i>
                                    <h5 class="card-title">City Management</h5>
                                    <p class="card-text">Manage cities</p>
                                    <a href="{{ route('admin.settings.city') }}" class="btn btn-dark">Manage Cities</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
