@extends('admin.layouts.master')
@section('title', 'Categories')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Category List</h4>
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                {{-- <th>Image</th> --}}
                                                <th>General</th>
                                                {{-- <th>Subtitle</th>
                                                <th>Description</th> --}}
                                                {{-- <th>Status</th> --}}
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ 1 }}</td>
                                                <td>General Info</td>
                                                <td>
                                                    <a href="{{ route('admin.edit.general.details', encrypt(1)) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>

                                                    {{-- <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete({{ $item->id }})">
                                                        <i class="ti ti-trash"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $item->id }}"
                                                        action="{{ route('admin.category.destroy', encrypt($item->id)) }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive -->
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
@endsection