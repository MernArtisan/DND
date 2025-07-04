@extends('admin.layouts.master')
@section('title', 'Create Categories')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Create Category</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.category.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter title">
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="active">Active</option>
                                                    <option value="inactive">In Active</option>
                                                </select>
                                            </div>
                                            &nbsp;
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" name="image" accept='image/*'
                                                        onchange="readURL(this)" class="form-control">
                                                </div>
                                                <img src="{{ asset('default-man.png') }}" alt="No Image" id="img"
                                                    style='height:150px;'>

                                                <div class="mb-3 mt-4">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <a href="{{ route('admin.category.index') }}"
                                                        class="btn btn-secondary">Cancel</a>
                                                </div>
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
