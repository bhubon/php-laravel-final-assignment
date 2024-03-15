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
                        <li class="breadcrumb-item active" aria-current="page">All Applications</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center" style="justify-content: space-between;">
                <div>
                    <h5 class="mb-0">All Applications</h5>
                </div>
                <div>
                    <form action="" method="GET" class="d-flex">
                        <div class="mx-2">
                            <label for="job_id">Select Job</label>
                            <select name="job_id" id="job_id" class="form-control">
                                <option value="">Select Job</option>
                                @foreach($jobs as $job)
                                <option {{ request()->job_id == $job->id ? 'selected' : '' }} value="{{ $job->id }}">{{ $job->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mx-2">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                <option {{ request()->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                <option {{ request()->status == 'short-listed' ? 'selected' : '' }} value="short-listed">Short-Listed</option>
                                <option {{ request()->status == 'accepted' ? 'selected' : '' }} value="accepted">Accepted</option>
                                <option {{ request()->status == 'rejected' ? 'selected' : '' }} value="rejected">Rejected</option>
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
                            <th>Canidate Name</th>
                            <th>Job Title</th>
                            <th>Applied At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($applications) > 0)
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->user->first_name }} {{ $application->user->last_name }}</td>
                                    <td><a href="{{ route('jobs.edit',$application->job->id) }}">{{ $application->job->title }}</a></td>
                                    <td>{{ date('d M, Y h:i A', strtotime($application->created_at)) }}</td>
                                    <td>{{ ucwords($application->status) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @can('edit job application')
                                            <a href="{{ route('applications.edit', $application->id) }}"
                                                class="btn btn-sm btn-warning mx-2">View Details</a>
                                            @endcan
                                            
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
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
