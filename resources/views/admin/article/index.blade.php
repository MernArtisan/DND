    @extends('admin.layouts.master')
    @section('title', 'Article')
    @section('content')
        <div class="wrapper">
            <div class="page-content">
                <div class="page-container">
                    <div class="row">
                        <div class="col-lg-12">
                            &nbsp;
                            <div class="card">
                                <div class="card-header border-bottom border-dashed d-flex justify-content-between">
                                    <h4 class="header-title">Article List</h4>
                                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">Add New</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($articles as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <img src="{{ $item->images->first()?->image ? asset($item->images->first()->image) : asset('default-man.png') }}"
                                                                alt="Banner Image" class="avatar-sm rounded" />
                                                        </td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ Str::limit(strip_tags($item->description), 20, '...') }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-info view-details"
                                                                data-name="{{ $item->name }}"
                                                                data-description="{{ strip_tags($item->description) }}"
                                                                data-images='@json($item->images->pluck('image'))'>
                                                                <i class="ti ti-eye"></i>
                                                            </button>

                                                            <a href="{{ route('admin.articles.edit', encrypt($item->id)) }}"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="ti ti-pencil"></i>
                                                            </a>

                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="confirmDelete({{ $item->id }})">
                                                                <i class="ti ti-trash"></i>
                                                            </button>

                                                            <form id="delete-form-{{ $item->id }}"
                                                                action="{{ route('admin.articles.destroy', encrypt($item->id)) }}"
                                                                method="POST" class="d-none">
                                                                @csrf
                                                                @method('DELETE')
                                                                {{--  --}}
                                                            </form>
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
        <!-- Article Details Modal -->

        <div class="modal fade" id="articleDetailsModal" tabindex="-1" aria-labelledby="articleDetailsLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Article Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name:</label>
                            <p id="modal-article-name" class="mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description:</label>
                            <p id="modal-article-description" class="mb-0"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Images:</label>
                            <div id="carouselContainer">
                                <div id="articleImageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner" id="carousel-inner">
                                        <!-- JS inserts items here -->
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#articleImageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"
                                            style="filter: invert(0); background-color: rgba(0,0,0,0.3); border-radius: 50%;"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#articleImageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"
                                            style="filter: invert(0); background-color: rgba(0,0,0,0.3); border-radius: 50%;"></span>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endsection
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const viewButtons = document.querySelectorAll('.view-details');

                viewButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const name = this.dataset.name;
                        const description = this.dataset.description;
                        const images = JSON.parse(this.dataset.images);

                        document.getElementById('modal-article-name').innerText = name;
                        document.getElementById('modal-article-description').innerText = description;

                        const carouselInner = document.getElementById('carousel-inner');
                        carouselInner.innerHTML = '';

                        if (images.length === 0) {
                            carouselInner.innerHTML =
                                `<div class="text-muted">No images available.</div>`;
                        } else {
                            images.forEach((path, index) => {
                                const activeClass = index === 0 ? 'active' : '';
                                carouselInner.innerHTML += `
                                <div class="carousel-item ${activeClass}">
                                    <img src="{{ asset('') }}${path}" class="d-block mx-auto"
                                    style="max-height: 220px; width: auto; object-fit: contain;" alt="Article Image ${index + 1}">
                                </div>
                            `;
                            });
                        }

                        const modal = new bootstrap.Modal(document.getElementById(
                            'articleDetailsModal'));
                        modal.show();
                    });
                });
            });
        </script>
    @endsection
