@extends('admin.layouts.master')
@section('title', 'General Details')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                &nbsp;
                <div class="row justify-content-center">
                    <div class="col-lg-10 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom d-flex align-items-center">
                                <h4 class="header-title mb-0 text-primary fw-bold">General Details</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.update.general.details', encrypt($general->id)) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gy-4">

                                        {{-- General Info --}}
                                        <div class="col-12">
                                            <div class="card bg-light-subtle border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-dark fw-semibold mb-4">
                                                        <i class="fas fa-info-circle me-2 text-primary"></i>General Info
                                                    </h5>
                                                    <div class="row">
                                                        @foreach ([
                                                            'Welcome Message' => 'welcome',
                                                            'Description' => 'description',
                                                            'Address' => 'address',
                                                            'Phone' => 'phone',
                                                            'Email' => 'email'
                                                        ] as $label => $field)
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-semibold">{{ $label }}</label>
                                                                <input type="{{ $field === 'email' ? 'email' : 'text' }}"
                                                                    name="{{ $field }}"
                                                                    class="form-control"
                                                                    value="{{ old($field, $general->$field) }}"
                                                                    placeholder="Enter {{ strtolower($label) }}" required>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Social Links --}}
                                        <div class="col-12">
                                            <div class="card bg-light-subtle border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-dark fw-semibold mb-4">
                                                        <i class="fab fa-facebook me-2 text-primary"></i>Social Links
                                                    </h5>
                                                    <div class="row">
                                                        @foreach ([
                                                            'Facebook URL' => 'facebook',
                                                            'Twitter URL' => 'twitter',
                                                            'Instagram URL' => 'instagram',
                                                            'YouTube URL' => 'youtube',
                                                            'LinkedIn URL' => 'linkedin'
                                                        ] as $label => $field)
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-semibold">{{ $label }}</label>
                                                                <input type="url" name="{{ $field }}" class="form-control"
                                                                    value="{{ old($field, $general->$field) }}"
                                                                    placeholder="Enter {{ $label }}" required>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Footer Info --}}
                                        <div class="col-12">
                                            <div class="card bg-light-subtle border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-dark fw-semibold mb-4">
                                                        <i class="fas fa-pen-fancy me-2 text-primary"></i>Footer Info
                                                    </h5>
                                                    <div class="row">
                                                        @foreach ([
                                                            'Get In Touch' => 'getintouch',
                                                            'Copyright Text' => 'copyright',
                                                            'DND Sports Text' => 'dndsports',
                                                            'Rights Text' => 'rights'
                                                        ] as $label => $field)
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-semibold">{{ $label }}</label>
                                                                <input type="text" name="{{ $field }}" class="form-control"
                                                                    value="{{ old($field, $general->$field) }}"
                                                                    placeholder="Enter {{ strtolower($label) }}" required>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Opening Hours --}}
                                        <div class="col-12">
                                            <div class="card bg-light-subtle border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-dark fw-semibold mb-4">
                                                        <i class="fas fa-clock me-2 text-primary"></i>Opening Hours
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Hours (Mon - Fri)</label>
                                                            <input type="text" name="mon-fri" class="form-control"
                                                                value="{{ old('mon-fri', $general->{'mon-fri'} ?? '') }}"
                                                                placeholder="Enter Mon-Fri hours" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Hours (Saturday)</label>
                                                            <input type="text" name="sat" class="form-control"
                                                                value="{{ old('sat', $general->sat) }}"
                                                                placeholder="Enter Saturday hours" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-semibold">Hours (Sunday)</label>
                                                            <input type="text" name="sun" class="form-control"
                                                                value="{{ old('sun', $general->sun) }}"
                                                                placeholder="Enter Sunday hours" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Map --}}
                                        <div class="col-12">
                                            <div class="card bg-light-subtle border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-dark fw-semibold mb-4">
                                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>Map Location
                                                    </h5>
                                                    <label class="form-label fw-semibold">Google Map Embed/Link</label>
                                                    <input type="text" name="map" class="form-control"
                                                        value="{{ old('map', $general->map) }}"
                                                        placeholder="Enter map link or embed code" required>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Submit --}}
                                        <div class="col-12 text-end mt-4">
                                            <button type="submit" class="btn btn-primary px-4">Update</button>
                                            <a href="{{ route('admin.dashboard') }}"
                                                class="btn btn-outline-secondary ms-2">Cancel</a>
                                        </div>

                                    </div> <!-- end row -->
                                </form>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end page-content -->
    </div> <!-- end wrapper -->
@endsection
