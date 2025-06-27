@extends('admin.layouts.master')
@section('title', 'Create Article')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Create Article</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.articles.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="Enter Name">
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subtitle</label>
                                                <input type="text" name="subtitle" class="form-control"
                                                    placeholder="Enter subtitle">
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="form-label">Description</label>
                                            <textarea id="description" name="description" class="form-control summernote" placeholder="Enter description"></textarea>
                                        </div>
                                    </div>

                                    &nbsp;

                                    {{-- <div class="mb-3">
                                        <label class="form-label">Platform</label>
                                        <select name="platform" class="form-select">
                                            <option value="web">Web</option>
                                            <option value="app">App</option>
                                            <option value="both">Both</option>
                                        </select>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Images</label>
                                            <input type="file" name="images[]" accept="image/*" multiple
                                                onchange="previewMultipleImages(event)" class="form-control">
                                        </div>

                                        <div id="preview-container" class="d-flex flex-wrap gap-2"></div>

                                        <div class="mb-3 mt-4">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="{{ route('admin.articles.index') }}"
                                                class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->
    </div>
@endsection

@section('scripts')
    <script>
        function previewMultipleImages(event) {
            const files = event.target.files;
            const container = document.getElementById('preview-container');
            container.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '100px';
                    img.style.marginRight = '10px';
                    img.style.borderRadius = '8px';
                    container.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

@endsection
