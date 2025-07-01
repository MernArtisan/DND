@extends('admin.layouts.master')
@section('title', 'Corporate Sponsors')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Corporate Sponsors List</h4>
                                <a href="{{ route('admin.corporate-sponsors.create') }}" class="btn btn-primary btn-sm">Add
                                    New</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sponsors as $sponsor)
                                                <tr>
                                                    <td>{{ $sponsor->id }}</td>
                                                    <td>
                                                        <img src="{{ $sponsor->image ? asset('storage/' . $sponsor->image) : asset('default-logo.png') }}"
                                                            alt="Logo" class="avatar-sm rounded" />
                                                    </td>
                                                    <td>{{ $sponsor->name ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($sponsor->link)
                                                            <a href="{{ $sponsor->link }}" target="_blank"
                                                                class="btn btn-sm btn-outline-primary">Visit</a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $sponsor->status ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $sponsor->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.corporate-sponsors.edit', encrypt($sponsor->id)) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $sponsor->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $sponsor->id }}"
                                                            action="{{ route('admin.corporate-sponsors.destroy', encrypt($sponsor->id)) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this sponsor?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
