@extends('company.company-layout')
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $total_jobs }}</h5>
                        <div class="ms-auto">
                            <i class="bx bx-category text-white"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Job Posts</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $total_employe }}</h5>
                        <div class="ms-auto">
                            <i class="bx bx-category text-white"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Employee</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{ $application_count }}</h5>
                        <div class="ms-auto">
                            <i class="bx bx-category text-white"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Applied Candidates</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Latest Jobs</h5>
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
                            <th>Deadline</th>
                            <th>Applied Yet</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($jobs) > 0)
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ date('d m,Y', strtotime($job->deadline)) }}</td>
                                    <td>applied</td>
                                    <td>{{ $job->status }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @can('view jobs')
                                                <a href="{{ route('jobs.edit', $job->id) }}"
                                                    class="btn btn-sm btn-warning mx-2">Edit</a>
                                            @endcan
                                            @can('delete jobs')
                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure to delete?')"
                                                        class="btn btn-sm btn-danger">Delete</button>
                                                </form>
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
            </div>
        </div>
    </div>
@endsection
