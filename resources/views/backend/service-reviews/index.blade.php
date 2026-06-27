@extends('backend.layouts.main')

@section('container')
    <main id="main" class="main">
        <div class="container-fluid">

            <div class="pagetitle">
                <h1>Service Reviews</h1>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Service Reviews
                        </li>
                    </ol>
                </nav>
            </div>

            <section class="section">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                <div class="card">

                    <div class="card-header">

                        <div class="row g-3 align-items-end">

                            <div class="col-lg-8">

                                <form method="GET">

                                    <div class="row g-2">

                                        <div class="col-md-6">

                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Search name, email, review or service...">

                                        </div>

                                        <div class="col-md-4">

                                            <select name="status" class="form-select">

                                                <option value="">All Status</option>

                                                <option value="pending" @selected(request('status') == 'pending')>
                                                    Pending
                                                </option>

                                                <option value="approved" @selected(request('status') == 'approved')>
                                                    Approved
                                                </option>

                                                <option value="rejected" @selected(request('status') == 'rejected')>
                                                    Rejected
                                                </option>

                                            </select>

                                        </div>

                                        <div class="col-md-2 d-grid">

                                            <button class="btn btn-primary">
                                                <i class="bx bx-search"></i>
                                            </button>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead>

                                    <tr>

                                        <th>#</th>

                                        <th>Reviewer</th>

                                        <th>Service</th>

                                        <th>Rating</th>

                                        <th>Status</th>

                                        <th>Date</th>

                                        <th width="220">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($reviews as $review)
                                        <tr>

                                            <td>

                                                {{ $loop->iteration + ($reviews->firstItem() - 1) }}

                                            </td>

                                            <td>

                                                <strong>

                                                    {{ $review->name }}

                                                </strong>

                                                <br>

                                                <small class="text-muted">

                                                    {{ $review->email ?: '-' }}

                                                </small>

                                            </td>

                                            <td>

                                                {{ $review->service->title }}

                                            </td>

                                            <td>

                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rating)
                                                        <i class="bx bxs-star text-warning"></i>
                                                    @else
                                                        <i class="bx bx-star text-muted"></i>
                                                    @endif
                                                @endfor

                                            </td>

                                            <td>

                                                @switch($review->status)
                                                    @case('approved')
                                                        <span class="badge bg-success">
                                                            Approved
                                                        </span>
                                                    @break

                                                    @case('rejected')
                                                        <span class="badge bg-danger">
                                                            Rejected
                                                        </span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-warning">
                                                            Pending
                                                        </span>
                                                @endswitch

                                            </td>

                                            <td>

                                                {{ $review->created_at->format('d M Y') }}

                                                <br>

                                                <small class="text-muted">

                                                    {{ $review->created_at->format('h:i A') }}

                                                </small>

                                            </td>

                                            <td>

                                                <div class="d-flex gap-1 flex-wrap">

                                                    <a href="{{ route('admin.service-reviews.show', $review) }}"
                                                        class="btn btn-sm btn-info">

                                                        <i class="bx bx-show"></i>

                                                    </a>

                                                    @if ($review->status != 'approved')
                                                        <form action="{{ route('admin.service-reviews.approve', $review) }}"
                                                            method="POST">

                                                            @csrf
                                                            @method('PATCH')

                                                            <button class="btn btn-success btn-sm">

                                                                <i class="bx bx-check"></i>

                                                            </button>

                                                        </form>
                                                    @endif

                                                    @if ($review->status != 'rejected')
                                                        <form action="{{ route('admin.service-reviews.reject', $review) }}"
                                                            method="POST">

                                                            @csrf
                                                            @method('PATCH')

                                                            <button class="btn btn-warning btn-sm">

                                                                <i class="bx bx-x"></i>

                                                            </button>

                                                        </form>
                                                    @endif

                                                    <form action="{{ route('admin.service-reviews.destroy', $review) }}"
                                                        method="POST" onsubmit="return confirm('Delete this review?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm">

                                                            <i class="bx bx-trash"></i>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                        @empty

                                            <tr>

                                                <td colspan="7" class="text-center py-5">

                                                    No reviews found.

                                                </td>

                                            </tr>
                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                            <div class="mt-3">

                                {{ $reviews->links() }}

                            </div>

                        </div>

                    </div>

                </section>

            </div>
        </main>
    @endsection
