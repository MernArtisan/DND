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
                                            <select name="billing_cycle" id="billingCycle" class="form-control" required>
                                                <option value="day"
                                                    {{ $subscription->billing_cycle == 'day' ? 'selected' : '' }}>Day
                                                </option>
                                                <option value="month"
                                                    {{ $subscription->billing_cycle == 'month' ? 'selected' : '' }}>Month
                                                </option>
                                                <option value="annual"
                                                    {{ $subscription->billing_cycle == 'annual' ? 'selected' : '' }}>Annual
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3" id="durationUnitContainer"
                                            style="display: {{ $subscription->billing_cycle == 'day' ? 'block' : 'none' }};">
                                            <label class="form-label">Duration Unit (Hours)</label>
                                            <input type="number" name="duration_unit" class="form-control"
                                                value="{{ $subscription->duration_unit }}" min="2" pattern="\d{2,}"
                                                {{ $subscription->billing_cycle == 'day' ? 'required' : '' }}>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea id="description" name="description" class="form-control summernote" rows="3" required>{{ $subscription->description }}</textarea>
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

        document.addEventListener('DOMContentLoaded', function() {
            const billingCycle = document.getElementById('billingCycle');
            const durationField = document.querySelector('[name="duration_unit"]');
            const container = document.getElementById('durationUnitContainer');

            // Initialize on page load
            toggleDurationField();

            // Handle changes
            billingCycle.addEventListener('change', toggleDurationField);

            function toggleDurationField() {
                if (billingCycle.value === 'day') {
                    container.style.display = 'block';
                    durationField.required = true;
                } else {
                    container.style.display = 'none';
                    durationField.required = false;
                }
            }

            // Form submission validation
            document.querySelector('form').addEventListener('submit', function(e) {
                if (billingCycle.value === 'day' &&
                    (durationField.value.length < 2 || parseInt(durationField.value) < 2)) {
                    e.preventDefault();
                    alert('Duration must be at least 2 digits and minimum value of 2');
                    durationField.focus();
                }
            });
        });
    </script>
@endsection
