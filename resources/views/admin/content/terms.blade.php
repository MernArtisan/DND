@extends('admin.layouts.master')
@section('title', content: 'Terms & Condition')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                &nbsp;

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">

                            <div class="card-header">
                                <h4>Edit Terms & Condition</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.terms-condition-update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="{{ $terms->name }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sub_name" class="form-label">Sub Name</label>
                                        <input type="text" id="sub_name" name="sub_name" class="form-control"
                                            value="{{ $terms->sub_name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description_1" name="description" class="form-control" rows="5" required>{{ $terms->description }}</textarea>
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
