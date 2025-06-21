@extends('admin.layouts.master')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Channels List</h4>
                                {{-- <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">Add New</a> --}}
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Streamer Name</th>
                                                <th>Channel Name</th>
                                                <th>Description</th>
                                                {{-- <th>Slug</th> --}}
                                                {{-- <th>Banner</th>
                                                <th>Logo</th> --}}
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($channels as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->streamer->name }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    {{-- <td>{{ $item->slug }}</td> --}}
                                                    {{-- <td>
                                                        <img src="{{ $item->banner ? asset('storage/' . $item->banner) : asset('default-man.png') }}"
                                                            alt="Banner" class="avatar-sm rounded" />
                                                    </td>
                                                    <td>
                                                        <img src="{{ $item->logo ? asset('storage/' . $item->logo) : asset('default-man.png') }}"
                                                            alt="Logo" class="avatar-sm rounded" />
                                                    </td> --}}
                                                    <td>
                                                        <button
                                                            class="btn btn-sm toggle-status {{ $item->is_active ? 'btn-success' : 'btn-danger' }}"
                                                            data-id="{{ $item->id }}">
                                                            {{ $item->is_active ? 'Active' : 'Block' }}
                                                        </button>
                                                    </td>
                                                    <td>

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

@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        $(document).on('click', '.toggle-status', function() {
            let button = $(this);
            let id = button.data('id');

            $.ajax({
                url: '{{ route('admin.channel.toggleStatus') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    if (response.success) {


                        button.text(response.status); // Text like "Active" or "Inactive"
                        button.removeClass('btn-success btn-danger')
                            .addClass(response.buttonClass); // Apply correct class

                        setTimeout(() => {
                            toastr.success(response.message);
                        }, 200);

                    } else {
                        toastr.error('Something went wrong.');
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            new DataTable('#myTable');
        });
    </script>
@endsection
