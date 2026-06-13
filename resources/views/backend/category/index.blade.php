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
                        <h4 class="mb-0">Manage Categories</h4>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i> Add Category
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Events Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                                </td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->events_count }}</td>
                                                <td>
                                                    <a href="{{ route('categories.show', $category->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $category->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>

                                                    <div class="modal fade" id="deleteModal{{ $category->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Category</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete
                                                                    "<strong>{{ $category->name }}</strong>"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <form
                                                                        action="{{ route('categories.destroy', $category->id) }}"
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
                                                <td colspan="5" class="text-center">No categories found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
