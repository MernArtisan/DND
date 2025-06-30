@extends('admin.layouts.master')
@section('title', isset($team) ? 'Edit Team Member' : 'Create Team Member')

@section('content')
<div class="wrapper">
    <div class="page-content">
        <div class="page-container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom border-dashed d-flex align-items-center">
                            <h4 class="header-title">
                                {{ isset($team) ? 'Edit Team Member' : 'Create Team Member' }}
                            </h4>
                        </div>

                        <div class="card-body">
                            <form
                                action="{{ isset($team) ? route('admin.teams.update', encrypt($team->id)) : route('admin.teams.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($team))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Enter team member's name"
                                                value="{{ old('name', $team->name ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="1" {{ old('status', $team->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $team->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote"
                                              placeholder="Enter description">{{ old('description', $team->description ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" accept="image/*" onchange="readURL(this)"
                                           class="form-control">
                                </div>

                                <div class="mb-3">
                                    <img id="img"
                                         src="{{ isset($team) && $team->image ? asset('storage/' . $team->image) : asset('default-man.png') }}"
                                         alt="Image" style="height: 150px;">
                                </div>

                                <div class="mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($team) ? 'Update' : 'Submit' }}
                                    </button>
                                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">Cancel</a>
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
