@extends('admin.layouts.master')
@section('title', content: 'Privacy Policy')

@section('content')

    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                &nbsp;

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h4>Edit Privacy Policy</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.privacy-policy-update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ $privacy->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sub_name" class="form-label">Sub Name</label>
                                        <input type="text" id="sub_name" name="sub_name" class="form-control"
                                            value="{{ $privacy->sub_name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        {{-- <textarea name="description" class="form-control summernote" rows="5" required>{{ $privacy->description }}</textarea> --}}
                                        <textarea id="description" name="description" class="form-control summernote">{{ $privacy->description }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
