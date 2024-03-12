@extends('company.company-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center" style="justify-content: space-between;">
                <div>
                    <h5 class="mb-0">All Jobs</h5>
                </div>
                <div>
                    <form action="" method="GET" class="d-flex">
                        <div>
                            <label for="month">Posted (Month)</label>
                            <input type="month" name="month" id="month" class="form-control" placeholder="Select Month"
                                value="{{ request()->input('month') ? \Carbon\Carbon::parse(request()->input('month'))->format('Y-m') : '' }}">
                        </div>

                        <div>
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control mx-2">
                                <option value="">Select</option>
                                <option {{ request()->status == 'active' ? 'selected' : '' }} value="active">Active
                                </option>
                                <option {{ request()->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                    Inactive</option>
                            </select>
                        </div>
                        <div class="mx-2">
                            <label for=""></label><br>
                            <button type="submit" class="btn btn-success mx-2">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Applied Yet</th>
                            <th>Posted On</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Candidates</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($jobs) > 0)
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ date('d M, Y', strtotime($job->deadline)) }}</td>
                                    <td>{{ count($job->applications) }}</td>
                                    <td>{{ date('d M, Y', strtotime($job->created_at)) }}</td>
                                    <td>
                                        @if ($job->status == 'active')
                                            <span class="btn btn-sm btn-success">{{ ucwords($job->status) }}</span>
                                        @else
                                            <span class="btn btn-sm btn-warning">{{ ucwords($job->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('jobs.edit', $job->id) }}"
                                                class="btn btn-sm btn-warning mx-2">Edit</a>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                    class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('applications.index') }}?job_id={{ $job->id }}"
                                            class="btn btn-sm btn-primary">View Candidates</a>
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
            </div>
        </div>
    </div>
@endsection
