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
                            <li class="breadcrumb-item active" aria-current="page">All Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Registered At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ ucwords($user->role) }}</td>
                                            <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    @can('edit users')
                                                        <a href="{{ route('admin.users.details', $user->id) }}"
                                                            class="btn btn-sm btn-warning mx-2">Edit / View</a>
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
