@extends('admin.layouts.master')
@section('title', 'Edit Category')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Edit Content</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.content.update', $cms_content->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">

                                        {{-- 1: Name --}}
                                        @if(in_array($cms_content->id, [3, 4, 5, 6, 7, 8, 9, 10]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $cms_content->name ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 2: Sub Name --}}
                                        @if(in_array($cms_content->value, []))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Sub Name</label>
                                                <input type="text" name="sub_name" class="form-control"
                                                    value="{{ old('sub_name', $cms_content->sub_name ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 3: Description --}}
                                        @if(in_array($cms_content->id, [3, 4, 5, 6, 7, 8, 9, 10]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control summernote"
                                                    rows="4">{{ old('description', $cms_content->description ?? '') }}</textarea>
                                            </div>
                                        @endif

                                        {{-- 4: Image --}}
                                        @if(in_array($cms_content->id, [4,3]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control" accept="image/*"
                                                    onchange="readURL(this)">
                                                <img id="img"
                                                    src="{{ $cms_content->image ? asset('storage/' . $cms_content->image) : asset('default-man.png') }}"
                                                    alt="Image" style="height: 150px;">
                                            </div>
                                        @endif

                                        {{-- 5: Video --}}
                                        @if(in_array($cms_content->id, []))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Video</label>
                                                <input type="text" name="video" class="form-control"
                                                    value="{{ old('video', $cms_content->video ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 6: Item 1 --}}
                                        @if(in_array($cms_content->id, [3,9, 10]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Item 1</label>
                                                <input type="text" name="item_1" class="form-control"
                                                    value="{{ old('item_1', $cms_content->item_1 ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 7: Description 1 --}}
                                        @if(in_array($cms_content->id, []))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Description 1</label>
                                                <textarea name="description_1" class="form-control"
                                                    rows="3">{{ old('description_1', $cms_content->description_1 ?? '') }}</textarea>
                                            </div>
                                        @endif

                                        {{-- 8: Item 2 --}}
                                        @if(in_array($cms_content->id, [3]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Item 2</label>
                                                <input type="text" name="item_2" class="form-control"
                                                    value="{{ old('item_2', $cms_content->item_2 ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 9: Description 2 --}}
                                        @if(in_array($cms_content->id, []))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Description 2</label>
                                                <textarea name="description_2" class="form-control"
                                                    rows="3">{{ old('description_2', $cms_content->description_2 ?? '') }}</textarea>
                                            </div>
                                        @endif

                                        {{-- 10: Item 3 --}}
                                        @if(in_array($cms_content->id, [3]))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Item 3</label>
                                                <input type="text" name="item_3" class="form-control"
                                                    value="{{ old('item_3', $cms_content->item_3 ?? '') }}">
                                            </div>
                                        @endif

                                        {{-- 11: Description 3 --}}
                                        @if(in_array($cms_content->id, []))
                                            <div class="col-12 mb-3">
                                                <label class="form-label">Description 3</label>
                                                <textarea name="description_3" class="form-control"
                                                    rows="3">{{ old('description_3', $cms_content->description_3 ?? '') }}</textarea>
                                            </div>
                                        @endif

                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.content.index') }}"
                                                class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end page-content -->
    </div> <!-- end wrapper -->
@endsection