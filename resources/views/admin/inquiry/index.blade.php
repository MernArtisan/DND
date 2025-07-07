@extends('admin.layouts.master')
@section('title', 'Inquiry')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title"> Inquiry </h4>
                                {{-- <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                --}}
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inquiries as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info view-message-btn"
                                                            data-bs-toggle="modal" data-bs-target="#inquiryModal"
                                                            data-id="{{ $item->id }}" data-message="{{ $item->message }}">
                                                            <i class="ti ti-eye"></i>
                                                            @if ($item->is_read == 0)
                                                                <span class="badge bg-danger">New Message</span>
                                                            @endif
                                                        </button>
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
    <!-- Inquiry Message Modal -->
    <div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inquiry Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="inquiryMessageContent">
                    <!-- Message will be injected here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const inquiryModal = document.getElementById('inquiryModal');

        inquiryModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const message = button.getAttribute('data-message');
            const id = button.getAttribute('data-id');

            // Inject message into modal
            document.getElementById('inquiryMessageContent').textContent = message;

            // 🔁 Mark as read using AJAX
            fetch(`/admin/inquiries/${id}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(res => {
                if (res.ok) {
                    // Optionally reload or update badge
                    button.querySelector('.badge')?.remove();
                }
            });
        });
    </script>
@endsection