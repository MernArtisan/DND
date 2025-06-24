@extends('admin.layouts.master')
@section('title', 'Banner')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Banner List</h4>
                                <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>

                                                <th>Title</th>
                                                <th>Subtitle</th>
                                                <th>Description</th>
                                                <th>Platform</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banner as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('default-man.png') }}"
                                                            alt="Banner Image" class="avatar-sm rounded" />

                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->subtitle }}</td>
                                                    <td>{{ Str::limit(strip_tags($item->description), 20, '...') }}</td>


                                                    <td>{{ $item->platform }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.banner.edit', encrypt($item->id)) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('admin.banner.destroy', encrypt($item->id)) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                            {{--  --}}
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
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
