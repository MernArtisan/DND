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
                                <h4 class="header-title">Create Home Banner</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.banner.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="Enter title">
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <label class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control summernote" placeholder="Enter description"></textarea>
                                            </div>

                                            &nbsp;

                                            <div class="mb-3">
                                                <label class="form-label">Platform</label>
                                                <select name="platform" class="form-select">
                                                    <option value="web">Web</option>
                                                    <option value="app">App</option>
                                                    <option value="both">Both</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="image" accept='image/*'
                                                        onchange="readURL(this)" class="form-control">
                                                </div>
                                                <img src="{{ asset('default-man.png') }}" alt="No Image" id="img"
                                                    style='height:150px;'>

                                                <div class="mb-3 mt-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('admin.banner.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle</label>
                                                <input type="text" name="subtitle" class="form-control"
                                                    placeholder="Enter subtitle">
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
