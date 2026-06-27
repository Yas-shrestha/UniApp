@extends('backend.layouts.main')

@section('container')
<main id="main" class="main">

   <div class="container-fluid">
     <div class="pagetitle">
        <h1>Testimonials</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Testimonials
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

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    All Testimonials
                </h5>

                <a
                    href="{{ route('admin.testimonials.create') }}"
                    class="btn btn-primary">

                    <i class="bx bx-plus"></i>

                    Add Testimonial

                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Role</th>

                            <th>Rating</th>

                            <th>Featured</th>

                            <th>Order</th>

                            <th width="180">Actions</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($testimonials as $testimonial)

                            <tr>

                                <td>

                                    {{ $testimonial->id }}

                                </td>

                                <td>

                                    <img
                                        src="{{ $testimonial->image_url }}"
                                        width="60"
                                        height="60"
                                        class="rounded-circle border object-fit-cover">

                                </td>

                                <td>

                                    <strong>

                                        {{ $testimonial->name }}

                                    </strong>

                                    @if($testimonial->company)

                                        <br>

                                        <small class="text-muted">

                                            {{ $testimonial->company }}

                                        </small>

                                    @endif

                                </td>

                                <td>

                                    {{ $testimonial->role ?: '-' }}

                                </td>

                                <td>

                                    @for($i=1;$i<=5;$i++)

                                        @if($i <= $testimonial->rating)

                                            <i class="bx bxs-star text-warning"></i>

                                        @else

                                            <i class="bx bx-star text-muted"></i>

                                        @endif

                                    @endfor

                                </td>

                                <td>

                                    @if($testimonial->is_featured)

                                        <span class="badge bg-success">

                                            Featured

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            Hidden

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $testimonial->sort_order }}

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.testimonials.show',$testimonial) }}"
                                        class="btn btn-sm btn-info">

                                        <i class="bx bx-show"></i>

                                    </a>

                                    <a
                                        href="{{ route('admin.testimonials.edit',$testimonial) }}"
                                        class="btn btn-sm btn-warning">

                                        <i class="bx bx-edit"></i>

                                    </a>

                                    <form
                                        action="{{ route('admin.testimonials.destroy',$testimonial) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this testimonial?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-sm btn-danger">

                                            <i class="bx bx-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-4">

                                    No testimonials found.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $testimonials->links() }}

                </div>

            </div>

        </div>

    </section>
   </div>

</main>
@endsection