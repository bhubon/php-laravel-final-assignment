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
                        <li class="breadcrumb-item active" aria-current="page">All Employee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">All Employee</h5>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Employee Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($employees) > 0)
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ ucwords($employee->employee_type) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @if (auth()->user()->id != $employee->id)
                                                <a href="{{ route('employee.edit', $employee->id) }}"
                                                    class="btn btn-sm btn-warning mx-2">Edit Employee / Permission</a>
                                                <form action="{{ route('employee.destroy', $employee->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure to delete?')"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            @endif
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
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
