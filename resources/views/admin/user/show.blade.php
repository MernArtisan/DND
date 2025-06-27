@extends('admin.layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            &nbsp;
            <div class="page-container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div
                                class="card-header d-flex justify-content-between align-items-center border-bottom border-dashed">
                                <h4 class="header-title mb-0">
                                    <i class="ti ti-user-circle text-primary me-1"></i>
                                    User Profile
                                </h4>
                                {{-- <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    <i class="ti ti-circle me-1"></i>
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span> --}}
                            </div>

                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="{{ $user->image ? asset($user->image) : asset('default-man.png') }}"
                                        alt="User Image" class="rounded-circle border shadow-sm" width="120"
                                        height="120">
                                </div>

                                <div class="mb-3">
                                    <h5 class="text-muted"><i class="ti ti-info-circle me-1"></i> Basic Information</h5>
                                    <div class="row">
                                        <div class="col-md-6"><strong><i class="ti ti-user me-1"></i> Name:</strong>
                                            {{ $user->name }}</div>
                                        <div class="col-md-6"><strong><i class="ti ti-phone me-1"></i> Phone:</strong>
                                            {{ $user->phone ?? '-' }}</div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><strong><i class="ti ti-calendar me-1"></i> Date of
                                                Birth:</strong> {{ $user->dob ?? '-' }}</div>
                                    </div>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <h5 class="text-muted"><i class="ti ti-map-pin me-1"></i> Location</h5>
                                    <div class="row">
                                        <div class="col-md-6"><strong>Country:</strong> {{ $user->country ?? '-' }}</div>
                                        <div class="col-md-6"><strong>State:</strong> {{ $user->state ?? '-' }}</div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><strong>City:</strong> {{ $user->city ?? '-' }}</div>
                                        <div class="col-md-6"><strong>Zipcode:</strong> {{ $user->zipcode ?? '-' }}</div>
                                    </div>
                                    <div class="mt-2"><strong>Address:</strong> {{ $user->address ?? '-' }}</div>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <h5 class="text-muted"><i class="ti ti-file-description me-1"></i> Bio</h5>
                                    <p class="mb-0">{{ $user->bio ?? '-' }}</p>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <h5 class="text-muted"><i class="ti ti-link me-1"></i> Social Links</h5>
                                    <div class="row">
                                        <div class="col-md-6"><strong><i class="ti ti-world me-1"></i> Website:</strong>
                                            {{ $user->website ?? '-' }}</div>
                                        <div class="col-md-6"><strong><i class="ti ti-brand-facebook me-1"></i>
                                                Facebook:</strong> {{ $user->facebook ?? '-' }}</div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><strong><i class="ti ti-brand-twitter me-1"></i>
                                                Twitter:</strong> {{ $user->twitter ?? '-' }}</div>
                                        <div class="col-md-6"><strong><i class="ti ti-brand-linkedin me-1"></i>
                                                LinkedIn:</strong> {{ $user->linkedin ?? '-' }}</div>
                                    </div>
                                </div>

                                <div class="mt-4 d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.editProfile') }}" class="btn btn-primary">
                                        <i class="ti ti-edit me-1"></i> Edit Profile
                                    </a>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                        <i class="ti ti-arrow-left me-1"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
