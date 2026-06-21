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
                        <h4 class="mb-0">Contact Messages</h4>
                        <div>
                            <span class="badge bg-danger fs-6 me-2">
                                <i class="bx bx-envelope me-1"></i> {{ $unreadCount }} Unread
                            </span>
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">
                                <i class="bx bx-refresh me-1"></i> Refresh
                            </a>
                        </div>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Contact Messages</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">

                            <form method="GET" action="{{ route('admin.contact.index') }}" class="row mb-3">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by name, email, company or job title" value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <select name="status" class="form-select">
                                        <option value="">All Status</option>
                                        <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread
                                        </option>
                                        <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read
                                        </option>
                                        <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>
                                            Replied</option>
                                    </select>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($messages as $message)
                                            <tr>
                                                <td>{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}
                                                </td>
                                                <td>
                                                    <strong>{{ $message->name }}</strong>
                                                    @if ($message->isUnread())
                                                        <span class="badge bg-danger ms-1">New</span>
                                                    @endif
                                                </td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ Str::limit($message->company_name, 30) }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $message->isUnread() ? 'danger' : ($message->isReplied() ? 'success' : 'info') }}">
                                                        {{ $message->status_label }}
                                                    </span>
                                                </td>
                                                <td>{{ $message->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.contact.show', $message->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $message->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $message->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Message</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete message from
                                                                    "<strong>{{ $message->name }}</strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form
                                                                        action="{{ route('admin.contact.destroy', $message->id) }}"
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
                                                <td colspan="7" class="text-center">No messages found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $messages->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
