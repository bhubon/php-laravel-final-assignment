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
                        <li class="breadcrumb-item active" aria-current="page">All Job Experience</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">All Job Experience</h5>
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
                            <th>Desgination</th>
                            <th>Copmany</th>
                            <th>Joining Date</th>
                            <th>Departure Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($items) > 0)
                            @php
                                $serialNumber = 0;
                            @endphp
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ ++$serialNumber }}</td>
                                    <td>{{ $item->designation }}</td>
                                    <td>{{ $item->company_name }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->joining_date)) }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->departure_date)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('user.job.experiences.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('user.job.experiences.delete', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger mx-2"
                                                    onclick="return confirm('Are you sure to delete?')"
                                                    type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
@endsection
