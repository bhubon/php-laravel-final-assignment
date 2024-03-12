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
                        <li class="breadcrumb-item active" aria-current="page">Application Detils</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Application Detils</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="row pb-10">
                <div class="col-md-4 offset-4">
                    <div class="actions">
                        @include('components.validatation')
                        <form action="{{ route('applications.update', $application->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="action">Action</label>
                                <select class="form-control" name="action" id="action">
                                    <option value="">Select
                                        Option</option>
                                    <option {{ $application->status == 'pending' ? 'selected' : '' }} value="pending">
                                        Pending</option>
                                    <option {{ $application->status == 'short-listed' ? 'selected' : '' }} value="short-listed">
                                        Short-List</option>
                                    <option {{ $application->status == 'accepted' ? 'selected' : '' }} value="accepted">
                                        Accept</option>
                                    <option {{ $application->status == 'rejected' ? 'selected' : '' }} value="rejected">
                                        Reject</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="details-data">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-2">Job Title: <a
                                href="{{ route('jobs.edit', $application->job->id) }}">{{ $application->job->title }}</a>
                        </h5>
                        <div class="details-data">
                            <div class="row justify-between user-date" style="justify-content: space-between !important;">
                                <div class="col-md-4 mt-2">
                                    <h5>User Details</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $application->user->candidate->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Father's Name</td>
                                                    <td>{{ $application->user->candidate->fathers_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mother's Name</td>
                                                    <td>{{ $application->user->candidate->mothers_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date of Birth</td>
                                                    <td>{{ $application->user->candidate->date_of_birth }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Blood Group</td>
                                                    <td>{{ $application->user->candidate->blood_group }}</td>
                                                </tr>
                                                @if (!empty($application->user->candidate->avatar))
                                                    <tr>
                                                        <td>Avatar</td>
                                                        <td><img src="{{ $application->user->candidate->avatar }}"
                                                                alt="Avatar" style="max-width: 100px;"></td>
                                                    </tr>
                                                @endif

                                                <tr>
                                                    <td>Social ID</td>
                                                    <td>{{ $application->user->candidate->social_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Passport Number</td>
                                                    <td>{{ $application->user->candidate->passport_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Emergency Contact Number</td>
                                                    <td>{{ $application->user->candidate->emergency_contact_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>WhatsApp Number</td>
                                                    <td>{{ $application->user->candidate->whatsapp_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Facebook Link</td>
                                                    <td>{{ $application->user->candidate->facebook_link }}</td>
                                                </tr>
                                                <tr>
                                                    <td>LinkedIn Link</td>
                                                    <td>{{ $application->user->candidate->linkedin_link }}</td>
                                                </tr>
                                                <tr>
                                                    <td>GitHub Link</td>
                                                    <td>{{ $application->user->candidate->github_link }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Behance Link</td>
                                                    <td>{{ $application->user->candidate->behance_link }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Portfolio Link</td>
                                                    <td>{{ $application->user->candidate->portfolio_link }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Resume</td>
                                                    <td><a href="{{ $application->user->candidate->resume }}" target="_blank" class="btn btn-sm btn-success">View Resume</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-center">Education</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Degree Type</th>
                                                    <th>Institute</th>
                                                    <th>Department</th>
                                                    <th>Passing Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $educations = $application->user->candidate->educations;
                                                @endphp
                                                @foreach ($educations as $education)
                                                    <tr>
                                                        <td>{{ $education->degree_type }}</td>
                                                        <td>{{ $education->institute_name }}</td>
                                                        <td>{{ $education->department }}</td>
                                                        <td>{{ $education->passing_year }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="text-center">Trainings</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Training</th>
                                                    <th>Institute</th>
                                                    <th>Passing Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $trainings = $application->user->candidate->trainings;
                                                @endphp
                                                @foreach ($trainings as $training)
                                                    <tr>
                                                        <td>{{ $training->training_name }}</td>
                                                        <td>{{ $training->institute_name }}</td>
                                                        <td>{{ $training->passing_year }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    <h5 class="text-center">Job Experience</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Designation</th>
                                                    <th>Company</th>
                                                    <th>Join Date</th>
                                                    <th>Departure Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $job_experiences = $application->user->candidate->job_experiences;
                                                @endphp
                                                @foreach ($job_experiences as $job_experience)
                                                    <tr>
                                                        <td>{{ $job_experience->designation }}</td>
                                                        <td>{{ $job_experience->company_name }}</td>
                                                        <td>{{ date('d M, Y', strtotime($job_experience->joining_date)) }}
                                                        </td>
                                                        <td>{{ date('d M, Y', strtotime($job_experience->departure_date)) }}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Skills</h5>
                                    @php
                                        $skills = $application->user->candidate->skills;
                                    @endphp
                                    @foreach ($skills as $skill)
                                        <span class="btn btn-sm btn-primary">{{ $skill->skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
