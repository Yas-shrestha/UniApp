@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Edit Blog Post</h4>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $blog->title) }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                                            id="author" name="author" value="{{ old('author', $blog->author) }}">
                                        @error('author')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="published_at" class="form-label">Published At</label>
                                        <input type="date"
                                            class="form-control @error('published_at') is-invalid @enderror"
                                            id="published_at" name="published_at"
                                            value="{{ old('published_at', \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d')) }}">
                                        @error('published_at')
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

                                        @if ($blog->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $blog->image) }}" height="80"
                                                    alt="{{ $blog->title }}">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3 d-flex align-items-center">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" id="is_featured"
                                                name="is_featured" value="1"
                                                {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                Mark as Featured
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="excerpt" class="form-label">Excerpt</label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                                        @error('excerpt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="body" class="form-label">Body</label>
                                        <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="8">{{ old('body', $blog->body) }}</textarea>
                                        @error('body')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label d-flex justify-content-between align-items-center">
                                            Quick Links
                                            <button type="button" class="btn btn-sm btn-primary" id="addQuickLink">
                                                <i class="bx bx-plus"></i> Add Link
                                            </button>
                                        </label>
                                        <div id="quickLinksWrapper">
                                            @php $links = old('quick_links', $blog->quick_links ?? []); @endphp
                                            @foreach ($links as $i => $link)
                                                <div class="row mb-2 quick-link-row">
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="quick_links[{{ $i }}][label]"
                                                            placeholder="Label" value="{{ $link['label'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control"
                                                            name="quick_links[{{ $i }}][url]"
                                                            placeholder="URL" value="{{ $link['url'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-danger remove-quick-link"><i
                                                                class="bx bx-trash"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>

    <script>
        let quickLinkIndex = {{ count(old('quick_links', $blog->quick_links ?? [])) }};

        document.getElementById('addQuickLink').addEventListener('click', function() {
            const wrapper = document.getElementById('quickLinksWrapper');
            const row = document.createElement('div');
            row.classList.add('row', 'mb-2', 'quick-link-row');
            row.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="quick_links[${quickLinkIndex}][label]" placeholder="Label">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="quick_links[${quickLinkIndex}][url]" placeholder="URL">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-quick-link"><i class="bx bx-trash"></i></button>
            </div>
        `;
            wrapper.appendChild(row);
            quickLinkIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-quick-link')) {
                e.target.closest('.quick-link-row').remove();
            }
        });
    </script>
@endsection
