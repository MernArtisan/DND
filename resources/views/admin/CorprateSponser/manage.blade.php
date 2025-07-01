@extends('admin.layouts.master')
@section('title', isset($sponsor) ? 'Edit Corporate Sponsor' : 'Create Corporate Sponsor')

@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">
                                    {{ isset($sponsor) ? 'Edit Corporate Sponsor' : 'Create Corporate Sponsor' }}
                                </h4>
                            </div>

                            <div class="card-body">
                                <form
                                    action="{{ isset($sponsor) ? route('admin.corporate-sponsors.update', encrypt($sponsor->id)) : route('admin.corporate-sponsors.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($sponsor))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Name (optional)</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter sponsor name"
                                                    value="{{ old('name', $sponsor->name ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Link</label>
                                                <input type="url" name="link" class="form-control"
                                                    placeholder="https://sponsor-website.com"
                                                    value="{{ old('link', $sponsor->link ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" name="image" accept="image/*" onchange="readURL(this)"
                                                class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <img id="img"
                                                src="{{ isset($sponsor) && $sponsor->image ? asset('storage/' . $sponsor->image) : asset('default-man.png') }}"
                                                alt="Image" style="height: 150px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="1"
                                                    {{ old('status', $sponsor->status ?? 1) == 1 ? 'selected' : '' }}>
                                                    Active</option>
                                                <option value="0"
                                                    {{ old('status', $sponsor->status ?? 1) == 0 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ isset($sponsor) ? 'Update' : 'Submit' }}
                                        </button>
                                        <a href="{{ route('admin.corporate-sponsors.index') }}"
                                            class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
