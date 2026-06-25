@extends('backend.layouts.main')

@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Past Event Gallery</h4>
                        <a href="{{ route('admin.event-galleries.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Gallery Images
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Past Event Gallery</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body py-4">

                            @if ($galleryImages->count())
                                <div class="row g-4">
                                    @foreach ($galleryImages as $gallery)
                                        <div class="col-md-4 col-lg-3">
                                            <div class="card h-100 shadow-sm border">
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/' . $gallery->image) }}"
                                                        alt="Gallery Image"
                                                        class="card-img-top"
                                                        style="height: 220px; object-fit: cover;">

                                                    <div class="position-absolute top-0 end-0 p-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger rounded-pill"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $gallery->id }}">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <p class="mb-1 small text-muted">
                                                        Uploaded: {{ $gallery->created_at->format('Y-m-d') }}
                                                    </p>
                                                    <p class="mb-0 small text-truncate">
                                                        {{ basename($gallery->image) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="deleteModal{{ $gallery->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Image</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this gallery image?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('admin.event-galleries.destroy', $gallery) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    {{ $galleryImages->links() }}
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bx bx-image fs-1 text-muted"></i>
                                    <h5 class="mt-3 mb-1">No gallery images found</h5>
                                    <p class="text-muted mb-3">Upload some past event images to display them here.</p>
                                    <a href="{{ route('admin.event-galleries.create') }}" class="btn btn-primary">
                                        <i class="bx bx-plus me-1"></i> Add Gallery Images
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection