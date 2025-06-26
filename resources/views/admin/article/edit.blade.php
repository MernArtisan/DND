@extends('admin.layouts.master')
@section('title', 'Edit Article')
@section('content')
    <div class="wrapper">
        <div class="page-content">
            <div class="page-container">
                <div class="row">
                    <div class="col-12">
                        &nbsp;
                        <div class="card">
                            <div class="card-header border-bottom border-dashed d-flex align-items-center">
                                <h4 class="header-title">Edit Article</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.articles.update', $article->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $article->name) }}" placeholder="Enter Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="form-label">Description</label>
                                            <textarea id="description" name="description" class="form-control summernote" placeholder="Enter description">{{ old('description', $article->description) }}</textarea>
                                        </div>
                                    </div>

                                    &nbsp;

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Upload New Images</label>
                                            <input type="file" name="images[]" accept="image/*" multiple
                                                onchange="previewMultipleImages(event)" class="form-control">
                                        </div>

                                        <div id="preview-container" class="d-flex flex-wrap gap-2"></div>

                                        @if ($article->images && $article->images->count())
                                            <label class="form-label mt-3">Existing Images</label>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach ($article->images as $img)
                                                    <div class="position-relative" style="display: inline-block;">
                                                        <img src="{{ asset($img->image) }}"
                                                            style="height: 100px; border-radius: 8px;">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                            style="border-radius: 50%; padding: 2px 6px; font-size: 12px;"
                                                            onclick="deleteImage({{ $img->id }})">×</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="mb-3 mt-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
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
    <script>
        function deleteImage(imageId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('admin.articles.deleteImage') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: imageId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Deleted!', 'Image has been deleted.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', 'Image could not be deleted.', 'error');
                            }
                        })
                        .catch(() => {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        });
                }
            });
        }
    </script>


@endsection
