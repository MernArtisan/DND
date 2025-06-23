@extends('admin.layouts.master')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Edit Home Banner</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="Enter title" value="{{ old('title', $banner->title) }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle</label>
                                                <input type="text" name="subtitle" class="form-control"
                                                    placeholder="Enter subtitle"
                                                    value="{{ old('subtitle', $banner->subtitle) }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control summernote" placeholder="Enter description">{{ old('description', $banner->description) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Platform</label>
                                                <select name="platform" class="form-select">
                                                    <option value="web"
                                                        {{ $banner->platform == 'web' ? 'selected' : '' }}>Web</option>
                                                    <option value="app"
                                                        {{ $banner->platform == 'app' ? 'selected' : '' }}>App</option>
                                                    <option value="both"
                                                        {{ $banner->platform == 'both' ? 'selected' : '' }}>Both</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="image" accept="image/*"
                                                    onchange="readURL(this)" class="form-control">
                                            </div>

                                            <img src="{{ asset('storage/' . ($banner->image ?? 'default-man.png')) }}"
                                                alt="Banner Image" id="img" style="height:150px;">
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3 mt-4">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="{{ route('admin.banner.index') }}"
                                                    class="btn btn-secondary">Cancel</a>
                                            </div>
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
