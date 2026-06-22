@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Edit Service</h4>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">Services</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.services.update', $service->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $service->title) }}"
                                            oninput="filterTitle(this)">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="text-danger small d-none" id="title-invalid-char">You cant add number in this field</div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select name="type" id="type"
                                            class="form-select @error('type') is-invalid @enderror">
                                            <option value="">-- Select Type --</option>
                                            <option value="traditional"
                                                {{ old('type', $service->type) == 'traditional' ? 'selected' : '' }}>
                                                Traditional</option>
                                            <option value="future"
                                                {{ old('type', $service->type) == 'future' ? 'selected' : '' }}>Future
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="icon" class="form-label">Icon (class name)</label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                            id="icon" name="icon" value="{{ old('icon', $service->icon) }}">
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($service->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $service->image) }}" height="80"
                                                    alt="{{ $service->title }}">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                            name="short_description" rows="2">{{ old('short_description', $service->short_description) }}</textarea>
                                        @error('short_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="body" class="form-label">Body</label>
                                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="8">{{ old('body', $service->body) }}</textarea>
                                        @error('body')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label d-flex justify-content-between align-items-center">
                                            Points
                                            <button type="button" class="btn btn-sm btn-primary" id="addPoint">
                                                <i class="bx bx-plus"></i> Add Point
                                            </button>
                                        </label>
                                        <div id="pointsWrapper">
                                            @php $points = old('points', $service->points ?? []); @endphp
                                            @foreach ($points as $point)
                                                <div class="input-group mb-2 point-row">
                                                    <input type="text" class="form-control" name="points[]"
                                                        value="{{ $point }}">
                                                    <button type="button" class="btn btn-danger remove-point"><i
                                                            class="bx bx-trash"></i></button>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('points')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="catalog_pdf" class="form-label">Catalog PDF</label>
                                        <input type="file"
                                            class="form-control @error('catalog_pdf') is-invalid @enderror"
                                            id="catalog_pdf" name="catalog_pdf" accept=".pdf">
                                        @error('catalog_pdf')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($service->catalog_pdf)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $service->catalog_pdf) }}"
                                                    target="_blank">View current PDF</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="catalog_doc" class="form-label">Catalog DOC</label>
                                        <input type="file"
                                            class="form-control @error('catalog_doc') is-invalid @enderror"
                                            id="catalog_doc" name="catalog_doc" accept=".doc,.docx">
                                        @error('catalog_doc')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($service->catalog_doc)
                                            <div class="mt-2">
                                                <a href="{{ asset('storage/' . $service->catalog_doc) }}"
                                                    target="_blank">View current DOC</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured"
                                                name="is_featured" value="1"
                                                {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Mark as Featured
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <script>
        document.getElementById('addPoint').addEventListener('click', function() {
            const wrapper = document.getElementById('pointsWrapper');
            const row = document.createElement('div');
            row.classList.add('input-group', 'mb-2', 'point-row');
            row.innerHTML = `
            <input type="text" class="form-control" name="points[]" placeholder="Point">
            <button type="button" class="btn btn-danger remove-point"><i class="bx bx-trash"></i></button>
        `;
            wrapper.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-point')) {
                e.target.closest('.point-row').remove();
            }
        });
    </script>
@endsection
