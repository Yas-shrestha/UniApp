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

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Registration Details</h4>
                        <div>
                            <a href="{{ route('admin.registrations.edit', $registration->id) }}" class="btn btn-primary">
                                <i class="bx bx-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.registrations.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.registrations.index') }}">Registrations</a>
                            </li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Registration Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Registration Code</div>
                                        <div class="col-md-8"><code>{{ $registration->registration_code }}</code></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Event</div>
                                        <div class="col-md-8">
                                            <a href="{{ route('events.show', $registration->event->slug ?? '#') }}">
                                                {{ $registration->event->title ?? 'N/A' }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Name</div>
                                        <div class="col-md-8">{{ $registration->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Email</div>
                                        <div class="col-md-8">{{ $registration->email }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Phone</div>
                                        <div class="col-md-8">{{ $registration->phone ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Participant Type</div>
                                        <div class="col-md-8">
                                            <span class="badge bg-info">
                                                {{ $registration->participant_type_label ?? $registration->participant_type }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Status</div>
                                        <div class="col-md-8">
                                            <span class="badge bg-{{ $registration->status_badge_color }}">
                                                {{ $registration->status_label }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Message / Requirements</div>
                                        <div class="col-md-8">{{ $registration->message ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Registered At</div>
                                        <div class="col-md-8">{{ $registration->created_at->format('d F Y, h:i A') }}</div>
                                    </div>
                                    @if ($registration->confirmed_at)
                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Confirmed At</div>
                                            <div class="col-md-8">{{ $registration->confirmed_at->format('d F Y, h:i A') }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-md-4 fw-bold">Last Updated</div>
                                        <div class="col-md-8">{{ $registration->updated_at->format('d F Y, h:i A') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Status Management</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="fw-bold">Current Status</label>
                                        <div>
                                            <span class="badge bg-{{ $registration->status_badge_color }} fs-6 p-2">
                                                {{ $registration->status_label }}
                                            </span>
                                        </div>
                                    </div>

                                    <form action="{{ route('admin.registrations.update', $registration->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Update Status</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="pending"
                                                    {{ $registration->status == 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="confirmed"
                                                    {{ $registration->status == 'confirmed' ? 'selected' : '' }}>Confirmed
                                                </option>
                                                <option value="cancelled"
                                                    {{ $registration->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bx bx-save me-1"></i> Update Status
                                        </button>
                                    </form>

                                    <hr>

                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $registration->email }}" class="btn btn-info">
                                            <i class="bx bx-envelope me-1"></i> Send Email
                                        </a>
                                        <a href="{{ route('admin.registrations.edit', $registration->id) }}"
                                            class="btn btn-warning">
                                            <i class="bx bx-edit me-1"></i> Edit Registration
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $registration->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete Registration
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $registration->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Registration</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
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
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Event Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>Event:</strong> {{ $registration->event->title ?? 'N/A' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Date:</strong> {{ $registration->event->date->format('d F Y') ?? 'N/A' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Time:</strong> {{ $registration->event->time ?? 'N/A' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Location:</strong> {{ $registration->event->location ?? 'N/A' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Total Registrations:</strong>
                                        {{ $registration->event->registrations()->count() ?? 0 }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Confirmed:</strong>
                                        {{ $registration->event->registrations()->where('status', 'confirmed')->count() ?? 0 }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Pending:</strong>
                                        {{ $registration->event->registrations()->where('status', 'pending')->count() ?? 0 }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Cancelled:</strong>
                                        {{ $registration->event->registrations()->where('status', 'cancelled')->count() ?? 0 }}
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('events.show', $registration->event->slug ?? '#') }}"
                                            class="btn btn-outline-primary" target="_blank">
                                            <i class="bx bx-link-external me-1"></i> View Event Page
                                        </a>
                                        <button class="btn btn-outline-secondary" onclick="window.print()">
                                            <i class="bx bx-printer me-1"></i> Print Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
