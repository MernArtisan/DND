@extends('admin.layouts.master')
@section('title', 'General Details')
@section('content')
<div class="wrapper">
    <div class="page-content">
        <div class="page-container">
            <div class="row">
                <div class="col-12">
                    &nbsp;
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex align-items-center">
                            <h4 class="header-title">General Details</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.update.general.details', encrypt($general->id)) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    {{-- General Info --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Welcome Message</label>
                                        <input type="text" name="welcome" class="form-control" value="{{ old('welcome', $general->welcome) }}" placeholder="Enter welcome message">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="description" class="form-control" value="{{ old('description', $general->description) }}" placeholder="Enter description">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $general->address) }}" placeholder="Enter address">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $general->phone) }}" placeholder="Enter phone number">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $general->email) }}" placeholder="Enter email address">
                                    </div>

                                    {{-- Social Links --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Facebook URL</label>
                                        <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $general->facebook) }}" placeholder="Enter Facebook link">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Twitter URL</label>
                                        <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $general->twitter) }}" placeholder="Enter Twitter link">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Instagram URL</label>
                                        <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $general->instagram) }}" placeholder="Enter Instagram link">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">YouTube URL</label>
                                        <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $general->youtube) }}" placeholder="Enter YouTube link">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">LinkedIn URL</label>
                                        <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $general->linkedin) }}" placeholder="Enter LinkedIn link">
                                    </div>

                                    {{-- Footer Info --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Get In Touch</label>
                                        <input type="text" name="getintouch" class="form-control" value="{{ old('getintouch', $general->getintouch) }}" placeholder="Enter get in touch text">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Copyright Text</label>
                                        <input type="text" name="copyright" class="form-control" value="{{ old('copyright', $general->copyright) }}" placeholder="Enter copyright text">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">DND Sports Text</label>
                                        <input type="text" name="dndsports" class="form-control" value="{{ old('dndsports', $general->dndsports) }}" placeholder="Enter DND Sports text">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Rights Text</label>
                                        <input type="text" name="rights" class="form-control" value="{{ old('rights', $general->rights) }}" placeholder="Enter rights text">
                                    </div>

                                    {{-- Opening Hours --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hours (Mon - Fri)</label>
                                        <input type="text" name="mon-fri" class="form-control" value="{{ old('mon-fri', $general->{'mon-fri'} ?? '') }}" placeholder="Enter Mon-Fri hours">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hours (Saturday)</label>
                                        <input type="text" name="sat" class="form-control" value="{{ old('sat', $general->sat) }}" placeholder="Enter Saturday hours">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hours (Sunday)</label>
                                        <input type="text" name="sun" class="form-control" value="{{ old('sun', $general->sun) }}" placeholder="Enter Sunday hours">
                                    </div>

                                    {{-- Map --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Google Map Embed/Link</label>
                                        <input type="text" name="map" class="form-control" value="{{ old('map', $general->map) }}" placeholder="Enter map link or embed code">
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('admin.general.details') }}" class="btn btn-secondary">Cancel</a>
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
