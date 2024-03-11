@extends('admin.admin-layout')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 text-white">{{ $jobs_count }}</h5>
                        <div class="ms-auto">
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Jobs</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 text-white">{{ $companies_count }}</h5>
                        <div class="ms-auto">
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Companies</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 text-white">{{ $candidates_count }}</h5>
                        <div class="ms-auto">
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Candidates</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h5 class="mb-0 text-white">Edited</h5>
                        <div class="ms-auto">
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Admin Employee</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Recent Jobs</h5>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Deadline</th>
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
                                    <td><a
                                            href="{{ route('companies.edit', $job->company->id) }}">{{ $job->company->company_name }}</a>
                                    </td>
                                    <td>{{ date('d M, Y', strtotime($job->created_at)) }}</td>
                                    <td>{{ Str::ucfirst($job->status) }}</td>
                                    <td>
                                        <a href="{{ route('admin.jobs.edit', $job->id) }}"
                                            class="btn btn-sm btn-success">View</a>
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
            </div>
        </div>
    </div>
@endsection
