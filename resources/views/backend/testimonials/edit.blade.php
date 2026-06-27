@extends('backend.layouts.main')

@section('container')
<main id="main" class="main">
<div class="container-fluid">

    <div class="pagetitle">
        <h1>Edit Testimonial</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.testimonials.index') }}">
                        Testimonials
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Edit
                </li>
            </ol>
        </nav>
    </div>

    <section class="section">

        <div class="card">

            <div class="card-header">
                <h5 class="mb-0">
                    Edit Testimonial
                </h5>
            </div>

            <div class="card-body pt-4">

                <form
                    action="{{ route('admin.testimonials.update', $testimonial) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $testimonial->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Role
                            </label>

                            <input
                                type="text"
                                name="role"
                                value="{{ old('role', $testimonial->role) }}"
                                class="form-control @error('role') is-invalid @enderror">

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Company
                            </label>

                            <input
                                type="text"
                                name="company"
                                value="{{ old('company', $testimonial->company) }}"
                                class="form-control @error('company') is-invalid @enderror">

                            @error('company')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Rating
                            </label>

                            <select
                                name="rating"
                                class="form-select @error('rating') is-invalid @enderror">

                                @for($i=5;$i>=1;$i--)

                                    <option
                                        value="{{ $i }}"
                                        {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>

                                        {{ $i }} Star{{ $i > 1 ? 's' : '' }}

                                    </option>

                                @endfor

                            </select>

                            @error('rating')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                name="sort_order"
                                value="{{ old('sort_order', $testimonial->sort_order) }}"
                                class="form-control @error('sort_order') is-invalid @enderror">

                            @error('sort_order')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Image
                            </label>

                            <input
                                type="file"
                                name="image"
                                class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        @if($testimonial->image)

                            <div class="col-12 mb-3">

                                <img
                                    src="{{ asset('storage/'.$testimonial->image) }}"
                                    class="img-thumbnail"
                                    style="height:120px;">

                            </div>

                        @endif

                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Testimonial
                            </label>

                            <textarea
                                name="testimonial"
                                rows="6"
                                class="form-control @error('testimonial') is-invalid @enderror">{{ old('testimonial', $testimonial->testimonial) }}</textarea>

                            @error('testimonial')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-12 mb-4">

                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    id="featured"
                                    {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>

                                <label
                                    class="form-check-label"
                                    for="featured">

                                    Featured Testimonial

                                </label>

                            </div>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bx bx-save me-1"></i>

                        Update Testimonial

                    </button>

                    <a
                        href="{{ route('admin.testimonials.index') }}"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </section>

</div>
</main>
@endsection