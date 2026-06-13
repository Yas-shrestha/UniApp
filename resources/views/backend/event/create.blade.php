@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Add Event</h4>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title') }}">
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
                                                    {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            id="date" name="date" value="{{ old('date') }}">
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="text" class="form-control @error('time') is-invalid @enderror"
                                            id="time" name="time" value="{{ old('time') }}"
                                            placeholder="e.g. 10:00 AM - 2:00 PM">
                                        @error('time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                            id="location" name="location" value="{{ old('location') }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="seats" class="form-label">Seats</label>
                                        <input type="text" class="form-control @error('seats') is-invalid @enderror"
                                            id="seats" name="seats" value="{{ old('seats') }}"
                                            placeholder="e.g. 50 seats available">
                                        @error('seats')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="admission" class="form-label">Admission</label>
                                        <input type="text" class="form-control @error('admission') is-invalid @enderror"
                                            id="admission" name="admission" value="{{ old('admission') }}"
                                            placeholder="e.g. Free / NPR 500">
                                        @error('admission')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="image" class="form-label">Event Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" name="image" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="intro" class="form-label">Intro</label>
                                        <textarea class="form-control @error('intro') is-invalid @enderror" id="intro" name="intro" rows="3">{{ old('intro') }}</textarea>
                                        @error('intro')
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
                                            @if (old('points'))
                                                @foreach (old('points') as $point)
                                                    <div class="input-group mb-2 point-row">
                                                        <input type="text" class="form-control" name="points[]"
                                                            value="{{ $point }}">
                                                        <button type="button" class="btn btn-danger remove-point"><i
                                                                class="bx bx-trash"></i></button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="input-group mb-2 point-row">
                                                    <input type="text" class="form-control" name="points[]"
                                                        placeholder="Point">
                                                    <button type="button" class="btn btn-danger remove-point"><i
                                                            class="bx bx-trash"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                        @error('points')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="audience" class="form-label">Audience</label>
                                        <textarea class="form-control @error('audience') is-invalid @enderror" id="audience" name="audience"
                                            rows="2">{{ old('audience') }}</textarea>
                                        @error('audience')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr>
                                    <h6 class="mb-3">Speaker Details</h6>

                                    <div class="col-md-4 mb-3">
                                        <label for="speaker_name" class="form-label">Speaker Name</label>
                                        <input type="text"
                                            class="form-control @error('speaker_name') is-invalid @enderror"
                                            id="speaker_name" name="speaker_name" value="{{ old('speaker_name') }}">
                                        @error('speaker_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="speaker_role" class="form-label">Speaker Role</label>
                                        <input type="text"
                                            class="form-control @error('speaker_role') is-invalid @enderror"
                                            id="speaker_role" name="speaker_role" value="{{ old('speaker_role') }}">
                                        @error('speaker_role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="speaker_image" class="form-label">Speaker Image</label>
                                        <input type="file"
                                            class="form-control @error('speaker_image') is-invalid @enderror"
                                            id="speaker_image" name="speaker_image" accept="image/*">
                                        @error('speaker_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
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
                const rows = document.querySelectorAll('.point-row');
                if (rows.length > 1) {
                    e.target.closest('.point-row').remove();
                }
            }
        });
    </script>
@endsection
