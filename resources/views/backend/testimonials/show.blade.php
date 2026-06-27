@extends('backend.layouts.main')

@section('container')
<main id="main" class="main">

    <div class="container-fluid">
        <div class="pagetitle">
        <h1>Testimonial Details</h1>

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
                    Details
                </li>
            </ol>
        </nav>
    </div>

    <section class="section">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>
        @endif

        <div class="row">

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-body text-center py-4">

                        <img
                            src="{{ $testimonial->image_url }}"
                            class="rounded-circle border mb-3"
                            width="140"
                            height="140"
                            style="object-fit:cover;">

                        <h4>

                            {{ $testimonial->name }}

                        </h4>

                        @if($testimonial->role)

                            <p class="text-muted mb-1">

                                {{ $testimonial->role }}

                            </p>

                        @endif

                        @if($testimonial->company)

                            <p class="text-muted">

                                {{ $testimonial->company }}

                            </p>

                        @endif

                        <div class="mt-3">

                            @for($i=1;$i<=5;$i++)

                                @if($i <= $testimonial->rating)

                                    <i class="bx bxs-star text-warning fs-4"></i>

                                @else

                                    <i class="bx bx-star text-muted fs-4"></i>

                                @endif

                            @endfor

                        </div>

                        <div class="mt-3">

                            @if($testimonial->is_featured)

                                <span class="badge bg-success">

                                    Featured

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    Hidden

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0">

                            Testimonial

                        </h5>

                    </div>

                    <div class="card-body">

                        <blockquote class="blockquote mb-4">

                            <p class="mb-0">

                                "{{ $testimonial->testimonial }}"

                            </p>

                        </blockquote>

                        <hr>

                        <table class="table table-borderless">

                            <tr>

                                <th width="170">

                                    Sort Order

                                </th>

                                <td>

                                    {{ $testimonial->sort_order }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Featured

                                </th>

                                <td>

                                    {{ $testimonial->is_featured ? 'Yes' : 'No' }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Created

                                </th>

                                <td>

                                    {{ $testimonial->created_at->format('d M Y h:i A') }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Last Updated

                                </th>

                                <td>

                                    {{ $testimonial->updated_at->format('d M Y h:i A') }}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

                <div class="mt-3">

                    <a
                        href="{{ route('admin.testimonials.edit', $testimonial) }}"
                        class="btn btn-warning">

                        <i class="bx bx-edit me-1"></i>

                        Edit

                    </a>

                    <a
                        href="{{ route('admin.testimonials.index') }}"
                        class="btn btn-secondary">

                        <i class="bx bx-arrow-back me-1"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

    </section>

    </div>
</main>
@endsection