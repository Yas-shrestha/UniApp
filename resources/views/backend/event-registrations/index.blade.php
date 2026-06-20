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
                        <h4 class="mb-0">Event Registrations</h4>
                        <div>
                            <a href="{{ route('admin.registrations.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Add Registration
                            </a>
                            <a href="{{ route('admin.registrations.export') }}" class="btn btn-success">
                                <i class="bx bx-export me-1"></i> Export All
                            </a>
                        </div>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Registrations</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">

                            <form method="GET" action="{{ route('admin.registrations.index') }}" class="row mb-3">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by name, email or code" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="event_id" class="form-select">
                                        <option value="">All Events</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}"
                                                {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                                {{ $event->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                                            Confirmed</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">Reset</a>
                                    @if (request('event_id'))
                                        <a href="{{ route('admin.registrations.export', request('event_id')) }}"
                                            class="btn btn-success">
                                            <i class="bx bx-export me-1"></i> Export This Event
                                        </a>
                                    @endif
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Event</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Registration Code</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($registrations as $registration)
                                            <tr>
                                                <td>{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('events.show', $registration->event->slug ?? '#') }}">
                                                        {{ Str::limit($registration->event->title ?? 'N/A', 30) }}
                                                    </a>
                                                </td>
                                                <td>{{ $registration->name }}</td>
                                                <td>{{ $registration->email }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $registration->participant_type_label ?? $registration->participant_type }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $registration->status_badge_color }}">
                                                        {{ $registration->status_label }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <code>{{ $registration->registration_code }}</code>
                                                </td>
                                                <td>{{ $registration->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.registrations.show', $registration->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('admin.registrations.edit', $registration->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bx bx-edit"></i>
                                                    </a> --}}
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $registration->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $registration->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Registration</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete registration for
                                                                    "<strong>{{ $registration->name }}</strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form
                                                                        action="{{ route('admin.registrations.destroy', $registration->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">No registrations found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $registrations->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
