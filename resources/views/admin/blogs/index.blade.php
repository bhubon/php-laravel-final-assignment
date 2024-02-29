@extends('admin.admin-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">All Blogs</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if (!empty($blog->thumbnail))
                                            <img src="{{ $blog->thumbnail }}" alt="{{ $blog->title }}" style="width:60px;">
                                        @else
                                            <img src="{{ asset('admin/assets/images/placeholder.jpg') }}"
                                                alt="{{ $blog->title }}" style="width:60px;">
                                        @endif
                                    </td>
                                    <td>{{ $blog->status }}</td>
                                    <td>{{ date('d m,Y', strtotime($blog->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin-blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-warning mx-2">Edit</a>
                                            <form action="{{ route('admin-blogs.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <h6 class="text-center">No Data Found</h6>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
@endsection
