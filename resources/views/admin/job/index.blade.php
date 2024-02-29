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
                            <li class="breadcrumb-item active" aria-current="page">Jobs</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">All Jobs</h5>
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
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
