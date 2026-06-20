@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Add Registration</h4>
                        <a href="{{ route('admin.registrations.index') }}" class="btn btn-primary">
                            <i class="bx bx-arrow-back me-1"></i> Back to List
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Registrations</a>
                            </li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.registrations.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="event_id" class="form-label">Event</label>
                                        <select name="event_id" id="event_id"
                                            class="form-select @error('event_id') is-invalid @enderror" required>
                                            <option value="">-- Select Event --</option>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->id }}"
                                                    {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                                    {{ $event->title }} ({{ $event->date->format('Y-m-d') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('event_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status"
                                            class="form-select @error('status') is-invalid @enderror" required>
                                            <option value="">-- Select Status --</option>
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                                                Confirmed</option>
                                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}"
                                            placeholder="Optional">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="participant_type" class="form-label">Participant Type</label>
                                        <select name="participant_type" id="participant_type"
                                            class="form-select @error('participant_type') is-invalid @enderror" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="undergraduate"
                                                {{ old('participant_type') == 'undergraduate' ? 'selected' : '' }}>
                                                Undergraduate Student</option>
                                            <option value="postgraduate"
                                                {{ old('participant_type') == 'postgraduate' ? 'selected' : '' }}>
                                                Postgraduate Student</option>
                                            <option value="faculty"
                                                {{ old('participant_type') == 'faculty' ? 'selected' : '' }}>Faculty Member
                                            </option>
                                            <option value="alumni"
                                                {{ old('participant_type') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                                            <option value="external"
                                                {{ old('participant_type') == 'external' ? 'selected' : '' }}>External
                                                Guest</option>
                                        </select>
                                        @error('participant_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="message" class="form-label">Message / Special Requirements</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="3">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Registration</button>
                                <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
