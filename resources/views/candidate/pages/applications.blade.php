@extends('candidate.candidate-layout')
@section('content')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Applied Jobs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">All Applied Jobs</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Copmany</th>
                            <th>Deadline</th>
                            <th>Application Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($applications) > 0)
                            @php
                                $serialNumber = 0;
                            @endphp
                            @foreach ($applications as $application)
                                <tr>
                                    <td>{{ ++$serialNumber }}</td>
                                    <td>{{ $application->job->title }}</td>
                                    <td>{{ $application->job->company->company_name }}</td>
                                    <td>{{ date('d M, Y', strtotime($application->job->deadline)) }}</td>
                                    <td>
                                        @if ($application->status == 'short-listed')
                                            <span class="bt btn-sm btn-success">{{ ucwords($application->status) }}</span>
                                        @elseif ($application->status == 'rejected')
                                            <span class="bt btn-sm btn-danger">{{ ucwords($application->status) }}</span>
                                        @else
                                            <span class="bt btn-sm btn-primary">{{ ucwords($application->status) }}</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('frontend.jobs.details', $application->job_id) }}"
                                            class="btn btn-sm btn-primary">View Job</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
@endsection
