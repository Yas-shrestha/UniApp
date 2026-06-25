@extends('backend.layouts.main')

@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Add Past Event Gallery</h4>
                        <a href="{{ route('admin.event-galleries.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.event-galleries.index') }}">Past Event Gallery</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.event-galleries.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="images" class="form-label">Gallery Images</label>
                                    <input
                                        type="file"
                                        class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror"
                                        id="images"
                                        name="images[]"
                                        accept="image/*"
                                        multiple
                                    >

                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @error('images.*')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                    <div class="form-text">
                                        You can upload multiple images at once. Supported: jpg, jpeg, png, webp. Max size: 2MB each.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Live Preview</label>
                                    <div id="previewWrapper" class="row g-3"></div>

                                    <div id="emptyPreview" class="border rounded p-4 text-center text-muted">
                                        No images selected yet.
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Upload Images</button>
                                <a href="{{ route('admin.event-galleries.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <script>
        const imageInput = document.getElementById('images');
        const previewWrapper = document.getElementById('previewWrapper');
        const emptyPreview = document.getElementById('emptyPreview');

        let selectedFiles = [];

        function renderPreview() {
            previewWrapper.innerHTML = '';

            if (selectedFiles.length === 0) {
                emptyPreview.classList.remove('d-none');
                return;
            }

            emptyPreview.classList.add('d-none');

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-4 col-lg-3';

                    col.innerHTML = `
                        <div class="card h-100 shadow-sm border">
                            <div class="position-relative">
                                <img src="${e.target.result}" class="card-img-top" alt="Preview"
                                    style="height: 220px; object-fit: cover;">
                                <button type="button"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-pill remove-image"
                                    data-index="${index}">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <p class="mb-1 small fw-semibold text-truncate">${file.name}</p>
                                <p class="mb-0 small text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                            </div>
                        </div>
                    `;

                    previewWrapper.appendChild(col);
                };

                reader.readAsDataURL(file);
            });

            syncFileInput();
        }

        function syncFileInput() {
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            imageInput.files = dataTransfer.files;
        }

        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);

            if (!files.length) return;

            selectedFiles = [...selectedFiles, ...files];
            renderPreview();
        });

        document.addEventListener('click', function(e) {
            const removeBtn = e.target.closest('.remove-image');

            if (!removeBtn) return;

            const index = parseInt(removeBtn.dataset.index);
            selectedFiles.splice(index, 1);
            renderPreview();
        });

        imageInput.addEventListener('change', function(e) {
    const files = Array.from(e.target.files);

    if (!files.length) return;

    files.forEach(file => {
        const alreadyExists = selectedFiles.some(existing =>
            existing.name === file.name &&
            existing.size === file.size &&
            existing.lastModified === file.lastModified
        );

        if (!alreadyExists) {
            selectedFiles.push(file);
        }
    });

    renderPreview();
});
    </script>
@endsection