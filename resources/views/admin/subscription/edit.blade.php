@extends('admin.layouts.master')
@section('title', 'Edit Subscription')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Edit Subscription</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.subscription.update', $subscription->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $subscription->name }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" step="0.01" name="price" class="form-control"
                                                value="{{ $subscription->price }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Billing Cycle</label>
                                            <select name="billing_cycle" class="form-control" required>
                                                <option value="one-time"
                                                    {{ $subscription->billing_cycle == 'one-time' ? 'selected' : '' }}>
                                                    One-Time</option>
                                                <option value="annual"
                                                    {{ $subscription->billing_cycle == 'annual' ? 'selected' : '' }}>Annual
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Duration Unit</label>
                                            <select name="duration_unit" class="form-control" required>
                                                <option value="hours"
                                                    {{ $subscription->duration_unit == 'hours' ? 'selected' : '' }}>Hours
                                                </option>
                                                <option value="days"
                                                    {{ $subscription->duration_unit == 'days' ? 'selected' : '' }}>Days
                                                </option>
                                                <option value="months"
                                                    {{ $subscription->duration_unit == 'months' ? 'selected' : '' }}>Months
                                                </option>
                                                <option value="years"
                                                    {{ $subscription->duration_unit == 'years' ? 'selected' : '' }}>Years
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Duration Value</label>
                                            <input type="number" name="duration_value" class="form-control"
                                                value="{{ $subscription->duration_value }}" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3" required>{{ $subscription->description }}</textarea>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">Features</label>
                                            <input type="text" id="featuresInput" name="features" class="form-control"
                                                required>
                                        </div>


                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.subscription.index') }}"
                                                class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const input = document.querySelector('#featuresInput');
        const tagify = new Tagify(input);

        // Load existing features
        const oldFeatures = @json(json_decode($subscription->features));
        if (Array.isArray(oldFeatures)) {
            tagify.addTags(oldFeatures);
        }
    </script>
@endsection
