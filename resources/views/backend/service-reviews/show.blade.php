@extends('backend.layouts.main')

@section('container')
    <main id="main" class="main">
        <div class="container-fluid">

            <div class="pagetitle">
                <h1>Review Details</h1>

                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.service-reviews.index') }}">
                                Service Reviews
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Review Details
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

                <div class="row">

                    {{-- LEFT --}}
                    <div class="col-lg-8">

                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center">

                                <h5 class="mb-0">
                                    Review
                                </h5>

                                @switch($serviceReview->status)
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

                            </div>

                            <div class="card-body">

                                <div class="mb-4">

                                    <h6 class="text-muted">
                                        Rating
                                    </h6>

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $serviceReview->rating)
                                            <i class="bx bxs-star text-warning fs-4"></i>
                                        @else
                                            <i class="bx bx-star text-muted fs-4"></i>
                                        @endif
                                    @endfor

                                </div>

                                <div class="mb-4">

                                    <h6 class="text-muted">
                                        Review
                                    </h6>

                                    <div class="border rounded p-3 bg-light">

                                        {!! nl2br(e($serviceReview->review)) !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="col-lg-4">

                        <div class="card">

                            <div class="card-header">
                                <h5 class="mb-0">
                                    Reviewer Information
                                </h5>
                            </div>

                            <div class="card-body">

                                <table class="table table-borderless">

                                    <tr>

                                        <th width="120">
                                            Name
                                        </th>

                                        <td>

                                            {{ $serviceReview->name }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>
                                            Email
                                        </th>

                                        <td>

                                            {{ $serviceReview->email ?: '-' }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>
                                            Service
                                        </th>

                                        <td>

                                            {{ $serviceReview->service->title }}

                                        </td>

                                    </tr>

                                    <tr>

                                        <th>
                                            Submitted
                                        </th>

                                        <td>

                                            {{ $serviceReview->created_at->format('d M Y h:i A') }}

                                        </td>

                                    </tr>

                                    @if ($serviceReview->approved_at)
                                        <tr>

                                            <th>
                                                Approved
                                            </th>

                                            <td>

                                                {{ $serviceReview->approved_at->format('d M Y h:i A') }}

                                            </td>

                                        </tr>
                                    @endif

                                </table>

                            </div>

                        </div>

                        <div class="card mt-3">

                            <div class="card-header">
                                <h5 class="mb-0">
                                    Actions
                                </h5>
                            </div>

                            <div class="card-body d-grid gap-2">

                                @if ($serviceReview->status != 'approved')
                                    <form action="{{ route('admin.service-reviews.approve', $serviceReview) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-success w-100">

                                            <i class="bx bx-check-circle me-1"></i>

                                            Approve Review

                                        </button>

                                    </form>
                                @endif

                                @if ($serviceReview->status != 'rejected')
                                    <form action="{{ route('admin.service-reviews.reject', $serviceReview) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-warning w-100">

                                            <i class="bx bx-x-circle me-1"></i>

                                            Reject Review

                                        </button>

                                    </form>
                                @endif

                                @if ($serviceReview->status != 'pending')
                                    <form action="{{ route('admin.service-reviews.pending', $serviceReview) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-secondary w-100">

                                            <i class="bx bx-reset me-1"></i>

                                            Move to Pending

                                        </button>

                                    </form>
                                @endif

                                <form action="{{ route('admin.service-reviews.destroy', $serviceReview) }}" method="POST"
                                    onsubmit="return confirm('Delete this review permanently?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger w-100">

                                        <i class="bx bx-trash me-1"></i>

                                        Delete Review

                                    </button>

                                </form>

                                <a href="{{ route('admin.service-reviews.index') }}" class="btn btn-outline-primary w-100">

                                    <i class="bx bx-arrow-back me-1"></i>

                                    Back to Reviews

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>
    </main>
@endsection
