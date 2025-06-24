@extends('admin.layouts.master')
@section('title', 'Create Subscription')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Create Subscription</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.subscription.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter subscription name" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" step="0.01" name="price" class="form-control"
                                                placeholder="Enter price" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Billing Cycle</label>
                                            <select name="billing_cycle" class="form-control" required>
                                                <option value="">Select cycle</option>
                                                <option value="one-time">One-Time</option>
                                                <option value="annual">Annual</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Duration Unit</label>
                                            <select name="duration_unit" class="form-control" required>
                                                <option value="hours">Hours</option>
                                                <option value="days">Days</option>
                                                <option value="months">Months</option>
                                                <option value="years">Years</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Duration Value</label>
                                            <input type="number" name="duration_value" class="form-control"
                                                placeholder="e.g. 1, 12" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Short description..." required></textarea>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label class="form-label">Features</label>
                                            <input type="text" name="features" id="featuresInput" class="form-control"
                                                placeholder="e.g. HD Streaming, No Ads, Unlimited Downloads" required>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
