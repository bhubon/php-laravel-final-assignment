@extends('admin.admin-layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3">Dashboard</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Job Categores</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">All Categories</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>icon</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <img src="{{ !empty($category->icon) ? asset($category->icon) : asset('uploads/placeholder.jpg') }}"
                                                    alt="Icon" style="width:60px;">
                                            </td>
                                            <td>{{ date('d M, Y', strtotime($category->created_at)) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('edit job categories')
                                                        <a href="{{ route('job-category.edit', $category->id) }}"
                                                            class="btn btn-sm btn-warning mx-2">Edit</a>
                                                    @endcan

                                                    @can('delete job categories')
                                                        <form action="{{ route('job-category.destroy', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Are you sure to delete?')"
                                                                class="btn btn-sm btn-danger">Delete</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <h6 class="text-center my-4">No Data Found</h6>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
