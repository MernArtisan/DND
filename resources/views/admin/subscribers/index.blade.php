@extends('admin.layouts.master')
@section('title', 'Subscribers')
@section('content')
    <style>
        .pricing-card {
            background-color: #121212;
            color: #fff;
            padding: 25px;
            border-radius: 12px;
            position: relative;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .pricing-card.popular {
            border: 2px solid #e50914;
        }

        .pricing-card .ribbon {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #e50914;
            color: #fff;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 4px;
        }

        .pricing-header .title {
            font-size: 22px;
            font-weight: bold;
        }

        .pricing-header .subtitle {
            font-size: 14px;
            color: #ccc;
        }

        .pricing-price {
            font-size: 36px;
            margin: 20px 0;
            font-weight: bold;
        }

        .pricing-price .duration {
            font-size: 14px;
            color: #ccc;
        }

        .pricing-features ul {
            list-style: none;
            padding: 0;
        }

        .pricing-features li {
            margin: 10px 0;
            font-size: 15px;
        }
    </style>


    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-lg-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                <h4 class="header-title"> Subscribers </h4>
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
                                                <th>Plan</th>
                                                <th>Price</th>
                                                <th>Plan Cycle</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscribers as $index => $item)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $item->user->name}}</td>
                                                    <td>{{ $item->user->email}}</td>
                                                    <td>{{ $item->plan->name}}</td>
                                                    <td>{{ $item->plan->price}}</td>
                                                    <td>{{ $item->plan->billing_cycle}}</td>
                                                    <td>
                                                        <span
                                                            class="btn btn-sm {{ $item->plan->is_active ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $item->plan->is_active ? 'Active' : 'Expired' }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info view-subscriber"
                                                            data-id="{{ $item->id }}">
                                                            <i class="ti ti-eye"></i>
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
    <!-- Subscriber Modal -->
    <div class="modal fade" id="subscriberModal" tabindex="-1" aria-labelledby="subscriberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subscriber Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="subscriberDetails">
                    <!-- Content will be loaded here via AJAX -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).on('click', '.view-subscriber', function () {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('admin.subscribers.details') }}",
                type: 'GET',
                data: { id },
                success: function (res) {
                    if (res.success) {
                        const u = res.data.user;
                        const p = res.data.plan;
                        const features = JSON.parse(p.features || '[]');

                        let html = `
                            <div class="mb-4">
                                <h5>User Information</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> ${u.name}</p>
                                        <p><strong>Email:</strong> ${u.email}</p>
                                        <p><strong>Phone:</strong> ${u.phone ?? '-'}</p>
                                        <p><strong>Location:</strong> ${u.city ?? '-'}, ${u.state ?? '-'}, ${u.country ?? '-'}</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="mb-3">Plan Information</h5>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="pricing-card ${p.name.toLowerCase() === 'pro' ? 'popular' : ''}">
                                        ${p.name.toLowerCase() === 'pro' ? '<div class="ribbon">MOST POPULAR</div>' : ''}

                                        <div class="pricing-header">
                                            <div class="title">${p.name}</div>
                                            <div class="subtitle">${p.description ?? ''}</div>
                                        </div>

                                        <div class="pricing-price">
                                            $${p.price}
                                            <div class="duration">per ${p.billing_cycle} </div>
                                            <div class="duration">(${p.duration_unit}) </div>

                                        </div>

                                        <div class="pricing-features">
                                            <ul>`;
                        features.forEach(f => {
                            html += `<li><i class="fas fa-check text-success"></i> ${f}</li>`;
                        });
                        html += `       </ul>
                                        </div>

                                        <div class="pricing-footer mt-3">
                                            <span class="badge ${p.is_active ? 'bg-success' : 'bg-danger'}">
                                                ${p.is_active ? 'Active' : 'Expired'}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('#subscriberDetails').html(html);
                        $('#subscriberModal').modal('show');
                    } else {
                        toastr.error('Details not found.');
                    }
                }
            });
        });
    </script>
@endsection