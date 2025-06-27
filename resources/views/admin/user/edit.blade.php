@extends('admin.layouts.master')
@section('title', 'Edit Profile')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            &nbsp;
            <div class="page-container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-sm">
                            <div class="card-header border-bottom border-dashed">
                                <h4 class="header-title mb-0">
                                    <i class="ti ti-user-edit text-primary me-1"></i> Edit Profile
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.updateProfile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="text-center mb-4">
                                        <img id="profile-preview"
                                            src="{{ $user->image ? asset($user->image) : asset('default-man.png') }}"
                                            class="rounded-circle border shadow-sm" width="120" height="120"
                                            alt="Profile Image">
                                        <div class="mt-2">
                                            <input type="file" name="image" id="image-input"
                                                class="form-control form-control-sm w-50 mx-auto">
                                        </div>
                                    </div>

                                    <h5 class="text-muted mb-3"><i class="ti ti-info-circle me-1"></i> Basic Information
                                    </h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $user->name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $user->phone }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control"
                                                value="{{ $user->dob }}">
                                        </div>
                                    </div>

                                    <h5 class="text-muted mb-3"><i class="ti ti-map-pin me-1"></i> Address Information</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Country</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{ $user->country }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" class="form-control"
                                                value="{{ $user->state }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control"
                                                value="{{ $user->city }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Zipcode</label>
                                            <input type="text" name="zipcode" class="form-control"
                                                value="{{ $user->zipcode }}">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Full Address</label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $user->address }}">
                                    </div>

                                    <h5 class="text-muted mb-3"><i class="ti ti-file-description me-1"></i> Bio</h5>
                                    <div class="mb-4">
                                        <textarea name="bio" class="form-control" rows="3" placeholder="Tell us something about yourself">{{ $user->bio }}</textarea>
                                    </div>

                                    <h5 class="text-muted mb-3"><i class="ti ti-link me-1"></i> Social Links</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Website</label>
                                            <input type="url" name="website" class="form-control"
                                                value="{{ $user->website }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Facebook</label>
                                            <input type="url" name="facebook" class="form-control"
                                                value="{{ $user->facebook }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Twitter</label>
                                            <input type="url" name="twitter" class="form-control"
                                                value="{{ $user->twitter }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">LinkedIn</label>
                                            <input type="url" name="linkedin" class="form-control"
                                                value="{{ $user->linkedin }}">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="ti ti-device-floppy me-1"></i> Save Changes
                                        </button>
                                        <a href="{{ route('admin.showProfile') }}" class="btn btn-secondary">
                                            <i class="ti ti-arrow-left me-1"></i> Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('image-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
