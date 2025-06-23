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
                                <h4 class="header-title">Streamer List</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Streamer Name</th>
                                                <th>Email</th>
                                                {{-- <th>Slug</th> --}}
                                                <th>Image</th>
                                                {{-- <th>Logo</th> --}}
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
                                                    {{-- <td>{{ $item->description }}</td> --}}
                                                    {{-- <td>{{ $item->slug }}</td> --}}
                                                    <td>
                                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('default-man.png') }}"
                                                            alt="Banner" class="avatar-sm rounded" />
                                                    </td>
                                                    {{-- <td>
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
                                                        <button type="button" class="btn btn-sm btn-info view-streamer"
                                                            data-id="{{ $item->id }}">
                                                            <i class="ti ti-eye"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('admin.user-streamer.destroy', encrypt($item->id)) }}"
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
    <div class="modal fade" id="streamerModal" tabindex="-1" aria-labelledby="streamerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Streamer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="streamerDetails" class="container">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script> --}}

    <script>
        $(document).on('click', '.toggle-status', function() {
            let button = $(this);
            let id = button.data('id');

            $.ajax({
                url: '{{ route('admin.user-streamer.toggleStatus') }}',
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


        $(document).on('click', '.view-streamer', function() {
            const id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.user-streamer.details') }}",
                type: "GET",
                data: {
                    id
                },
                success: function(response) {
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
                    <hr>
                        `;

                        // CHANNELS
                        html += `<h5>Channels</h5>`;
                        if (Array.isArray(u.channel) && u.channel.length > 0) {
                            u.channel.forEach(c => {
                                html += `
                    <div class="border rounded p-3 mb-3">
                        <p><strong>Name:</strong> ${c.name}</p>
                        <p><strong>Description:</strong> ${c.description ?? '-'}</p>
                        <p><strong>Slug:</strong> ${c.slug ?? '-'}</p>
                        <p><strong>Banner:</strong><br>
                            <img src="${c.banner ? c.banner : '/default-man.png'}" width="150">

                        </p>
                        <p><strong>Logo:</strong><br>
                            <img src="${c.logo ? c.logo : '/default-man.png'}" width="80">
                        </p>
                        <p><strong>Status:</strong> ${c.is_active ? 'Active' : 'Inactive'}</p>
                    </div>
                        `;
                            });
                        } else {
                            html += `<p>No channels found.</p>`;
                        }

                        html += `<hr><h5>Streams</h5>`;
                        if (Array.isArray(u.stream) && u.stream.length > 0) {
                            u.stream.forEach(s => {
                                html += `
                    <div class="border rounded p-3 mb-3">
                        <p><strong>Title:</strong> ${s.title}</p>
                        <p><strong>Teams:</strong> ${s.team_1} (${s.team1_symbol}) vs ${s.team_2} (${s.team2_symbol})</p>
                        <p><strong>Date:</strong> ${s.date}</p>
                        <p><strong>Time:</strong> ${s.start_time} - ${s.end_time}</p>
                        <p><strong>Location:</strong> ${s.location} (${s.location_symbol})</p>
                        <p><strong>Description:</strong> ${s.description ?? '-'}</p>
                        <p><strong>Viewer Count:</strong> ${s.viewer_count ?? 0}</p>
                        <p><strong>Status:</strong> ${s.status}</p>
                        <p><strong>Image:</strong><br>
                            <img src="${s.image ? s.image : '/default-man.png'}" width="150">
                        </p>
                    </div>
                    `;
                            });
                        } else {
                            html += `<p>No streams found.</p>`;
                        }

                        $('#streamerDetails').html(html);
                        $('#streamerModal').modal('show');
                    } else {
                        toastr.error("Failed to load details.");
                    }
                }
            });
        });
    </script>
@endsection
