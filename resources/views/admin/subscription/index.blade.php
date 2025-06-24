@extends('admin.layouts.master')
@section('title', 'Subscription')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Subscription List</h4>
                                <a href="{{ route('admin.subscription.create') }}" class="btn btn-primary btn-sm">Add New</a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subscription Name</th>
                                                <th>Price</th>
                                                <th>Billing Cycle</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscriptions as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>
                                                    <td>{{ $item->billing_cycle }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info view-details"
                                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                            {{-- data-slug="{{ $item->slug }}"  --}} data-price="{{ $item->price }}"
                                                            data-billing_cycle="{{ $item->billing_cycle }}"
                                                            data-duration_unit="{{ $item->duration_unit }}"
                                                            data-duration_value="{{ $item->duration_value }}"
                                                            data-description="{{ $item->description }}"
                                                            data-is_active="{{ $item->is_active }}"
                                                            data-features='@json(json_decode($item->features))'>
                                                            <i class="ti ti-eye"></i>
                                                        </button>

                                                        <a href="{{ route('admin.subscription.edit', encrypt($item->id)) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="ti ti-pencil"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="ti ti-trash"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $item->id }}"
                                                            action="{{ route('admin.subscription.destroy', encrypt($item->id)) }}"
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

    <!-- Subscription Detail Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subscription Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Name:</strong> <span id="modal-name"></span></li>
                        {{-- <li class="list-group-item"><strong>Slug:</strong> <span id="modal-slug"></span></li> --}}
                        <li class="list-group-item"><strong>Price:</strong> <span id="modal-price"></span></li>
                        <li class="list-group-item"><strong>Billing Cycle:</strong> <span id="modal-billing-cycle"></span>
                        </li>
                        <li class="list-group-item"><strong>Duration:</strong> <span id="modal-duration"></span></li>
                        <li class="list-group-item"><strong>Description:</strong> <span id="modal-description"></span></li>
                        <li class="list-group-item"><strong>Status:</strong> <span id="modal-status"></span></li>
                        <li class="list-group-item">
                            <strong>Features:</strong>
                            <ul id="modal-features" class="mb-0 ps-3"></ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     new DataTable('#myTable');

        $(document).on('click', '.view-details', function() {
            $('#modal-name').text($(this).data('name'));
            $('#modal-price').text($(this).data('price'));
            $('#modal-billing-cycle').text($(this).data('billing_cycle'));
            $('#modal-duration').text($(this).data('duration_value') + ' ' + $(this).data('duration_unit'));
            $('#modal-description').text($(this).data('description'));
            $('#modal-status').text($(this).data('is_active') ? 'Active' : 'Inactive');

            let features = $(this).data('features');
            $('#modal-features').empty();

            try {
                if (Array.isArray(features)) {
                    features.forEach(f => {
                        $('#modal-features').append(`<li>${f}</li>`);
                    });
                } else {
                    $('#modal-features').append(`<li>${features}</li>`);
                }
            } catch (e) {
                $('#modal-features').append(`<li>Invalid JSON</li>`);
            }

            $('#subscriptionModal').modal('show');
        });
        // });
    </script>

@endsection
