@extends('admin.layouts.master')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">
                                    {{ isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial' }}
                                </h4>
                            </div>

                            <div class="card-body">
                                <form
                                    action="{{ isset($testimonial) ? route('admin.testimonials.update', encrypt($testimonial->id)) : route('admin.testimonials.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($testimonial))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter name"
                                                    value="{{ old('name', $testimonial->name ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Designation</label>
                                                <input type="text" name="designation" class="form-control"
                                                    placeholder="Enter designation"
                                                    value="{{ old('designation', $testimonial->designation ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Review</label>
                                        <textarea name="review" class="form-control summernote" placeholder="Enter review">{{ old('review', $testimonial->review ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Rating (1 to 5)</label>
                                        <input type="number" name="rating" min="1" max="5"
                                            class="form-control" placeholder="Enter rating"
                                            value="{{ old('rating', $testimonial->rating ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" accept="image/*" onchange="readURL(this)"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <img id="img"
                                            src="{{ isset($testimonial) && $testimonial->image ? asset('storage/'.$testimonial->image) : asset('default-man.png') }}"
                                            alt="Image" style="height: 150px;">
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($testimonial) ? 'Update' : 'Submit' }}
                                        </button>
                                        <a href="{{ route('admin.testimonials.index') }}"
                                            class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
