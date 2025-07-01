@extends('admin.layouts.master')
@section('title', 'Newsletter Subscribers')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title">Newsletter Subscribers</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Subscribed At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($newsletters as $index => $subscriber)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $subscriber->email }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $subscriber->status ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $subscriber->status ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No subscriptions found.</td>
                                                </tr>
                                            @endforelse
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