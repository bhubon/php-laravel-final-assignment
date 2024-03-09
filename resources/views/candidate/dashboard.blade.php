@extends('candidate.candidate-layout')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-2 text-white">{{ count($applications) }}</h5>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Applied Jobs  </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-2 text-white">{{ $success_applications }}</h5>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Success On Applied Jobs</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-2 text-white">{{ $experience }}</h5>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Job Experience</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-2 text-white">{{ $skills }}</h5>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Skills</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->


    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Latest Applied Jobs</h5>
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
                                        @if ($application->status == 'short-listed' ||$application->status == 'accepted' )
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
            </div>
        </div>
    </div>
@endsection
