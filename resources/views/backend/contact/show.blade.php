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
                        <h4 class="mb-0">Message Details</h4>
                        <div>
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to List
                            </a>
                        </div>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact Messages</a>
                            </li>
                            <li class="breadcrumb-item active">Details</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Message Information</h5>
                                    <span
                                        class="badge bg-{{ $message->isUnread() ? 'danger' : ($message->isReplied() ? 'success' : 'info') }} fs-6">
                                        {{ $message->status_label }}
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">From</div>
                                        <div class="col-md-9">{{ $message->name }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Email</div>
                                        <div class="col-md-9">
                                            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Phone</div>
                                        <div class="col-md-9">{{ $message->phone ?? 'N/A' }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Subject</div>
                                        <div class="col-md-9">{{ $message->subject }}</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Message</div>
                                        <div class="col-md-9">
                                            <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">
                                                {{ $message->message }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-3 fw-bold">Received</div>
                                        <div class="col-md-9">{{ $message->created_at->format('d F Y, h:i A') }}</div>
                                    </div>
                                    @if ($message->read_at)
                                        <div class="row mb-3">
                                            <div class="col-md-3 fw-bold">Read At</div>
                                            <div class="col-md-9">{{ $message->read_at->format('d F Y, h:i A') }}</div>
                                        </div>
                                    @endif
                                    @if ($message->replied_at)
                                        <div class="row mb-3">
                                            <div class="col-md-3 fw-bold">Replied At</div>
                                            <div class="col-md-9">{{ $message->replied_at->format('d F Y, h:i A') }}</div>
                                        </div>
                                        @if ($message->admin_reply)
                                            <div class="row mb-3">
                                                <div class="col-md-3 fw-bold">Admin Reply</div>
                                                <div class="col-md-9">
                                                    <div class="p-3 bg-success bg-opacity-10 rounded"
                                                        style="white-space: pre-wrap;">
                                                        {{ $message->admin_reply }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                                            <i class="bx bx-envelope me-1"></i> Reply via Email
                                        </a>

                                        @if ($message->isUnread())
                                            <form action="{{ route('admin.contact.read', $message->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-info w-100">
                                                    <i class="bx bx-check me-1"></i> Mark as Read
                                                </button>
                                            </form>
                                        @endif

                                        @if (!$message->isReplied())
                                            <form action="{{ route('admin.contact.replied', $message->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="bx bx-reply me-1"></i> Mark as Replied
                                                </button>
                                            </form>
                                        @endif

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $message->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete Message
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $message->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Message</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this message from
                                                    "<strong>{{ $message->name }}</strong>"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.contact.destroy', $message->id) }}"
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
                                    <h5 class="card-title mb-0">Quick Info</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>Status:</strong>
                                        <span
                                            class="badge bg-{{ $message->isUnread() ? 'danger' : ($message->isReplied() ? 'success' : 'info') }}">
                                            {{ $message->status_label }}
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>Created:</strong> {{ $message->created_at->diffForHumans() }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Total Messages:</strong> {{ \App\Models\Contact::count() }}
                                    </div>
                                    <div>
                                        <strong>Unread:</strong> {{ \App\Models\Contact::unread()->count() }}
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
