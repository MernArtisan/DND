@extends('admin.layouts.master')
@section('title', 'Teams')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Teams List</h4>
                                <a href="{{ route('admin.teams.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teams as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('default-man.png') }}"
                                                            alt="Team Image" class="avatar-sm rounded" />
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ Str::limit(strip_tags($item->description), 30, '...') }}</td>
                                                    <td>
                                                        
                                                        <span
                                                            class="badge {{ $item->status ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $item->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.teams.edit', encrypt($item->id)) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('admin.teams.destroy', encrypt($item->id)) }}"
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
        function confirmsDelete(id) {
            if (confirm('Are you sure you want to delete this team member?')) {
                document.getElementById('delete-forms-' + id).submit();
            }
        }
    </script>
@endsection
