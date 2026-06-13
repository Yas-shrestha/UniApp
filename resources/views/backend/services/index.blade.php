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
                        <h4 class="mb-0">Manage Services</h4>
                        <a href="{{ route('services.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Service
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Services</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">

                            <form method="GET" action="{{ route('services.index') }}" class="row mb-3">
                                <div class="col-md-4 mb-2">
                                    <select name="type" class="form-select">
                                        <option value="">All Types</option>
                                        <option value="traditional" {{ $type == 'traditional' ? 'selected' : '' }}>
                                            Traditional</option>
                                        <option value="future" {{ $type == 'future' ? 'selected' : '' }}>Future</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Featured</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($services as $service)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($service->image)
                                                        <img src="{{ asset('storage/' . $service->image) }}" height="50"
                                                            width="50" alt="{{ $service->title }}">
                                                    @else
                                                        <span class="text-muted">No image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $service->title }}</td>
                                                <td><span
                                                        class="badge bg-label-info text-capitalize">{{ $service->type }}</span>
                                                </td>
                                                <td>
                                                    @if ($service->is_featured)
                                                        <span class="badge bg-success">Yes</span>
                                                    @else
                                                        <span class="badge bg-secondary">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('services.show', $service->slug) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    <a href="{{ route('services.edit', $service->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $service->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $service->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Service</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete
                                                                    "<strong>{{ $service->title }}</strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form
                                                                        action="{{ route('services.destroy', $service->id) }}"
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
                                                <td colspan="6" class="text-center">No services found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
