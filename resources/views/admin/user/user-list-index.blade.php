@extends('admin.layouts.master')
@section('title', 'Users')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">User List</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        <img src="{{ $item->image ? asset($item->image) : asset('default-man.png') }}"
                                                            alt="Image" class="avatar-sm rounded" />
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-sm toggle-status {{ $item->is_active ? 'btn-success' : 'btn-danger' }}"
                                                            data-id="{{ $item->id }}">
                                                            {{ $item->is_active ? 'Active' : 'Block' }}
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info view-user"
                                                            data-id="{{ $item->id }}">
                                                            <i class="ti ti-eye"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('admin.user.destroy', encrypt($item->id)) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
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

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="userDetails" class="container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.toggle-status', function () {
            let button = $(this);
            let id = button.data('id');

            $.ajax({
                url: '{{ route('admin.user.toggleStatus') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        button.text(response.status);
                        button.removeClass('btn-success btn-danger')
                            .addClass(response.buttonClass);
                        setTimeout(() => {
                            toastr.success(response.message);
                        }, 200);
                    } else {
                        toastr.error('Something went wrong.');
                    }
                }
            });
        });

        $(document).on('click', '.view-user', function () {
            const id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.user.details') }}",
                type: "GET",
                data: { id },
                success: function (response) {
                    if (response.success) {
                        const u = response.data;
                        let html = `
                            <div class="row mb-3">
                                <div class="col-md-3 text-center">
                                    <img src="${u.image}" class="rounded-circle mb-2" width="100" height="100">
                                    <h5>${u.name}</h5>
                                    <p>${u.email}</p>
                                    <p><strong>Status:</strong> ${u.is_active ? 'Active' : 'Blocked'}</p>
                                </div>
                                <div class="col-md-9">
                                    <p><strong>Phone:</strong> ${u.phone_code ?? ''} ${u.phone ?? '-'}</p>
                                    <p><strong>Location:</strong> ${u.city ?? ''}, ${u.state ?? ''}, ${u.country ?? ''}</p>
                                    <p><strong>Bio:</strong> ${u.bio ?? '-'}</p>
                                </div>
                            </div>
                        `;
                        $('#userDetails').html(html);
                        $('#userModal').modal('show');
                    } else {
                        toastr.error("Failed to load details.");
                    }
                }
            });
        });
    </script>
@endsection