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
                        <li class="breadcrumb-item active" aria-current="page">All Education</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">All Education</h5>
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
                            <th>Degree</th>
                            <th>Institute</th>
                            <th>Department</th>
                            <th>CGPA / GPA</th>
                            <th>Passing Year</th>
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
                                    <td>{{ $item->degree_type }}</td>
                                    <td>{{ $item->institute_name }}</td>
                                    <td>{{ $item->department }}</td>
                                    <td>{{ $item->cgpa }}</td>
                                    <td>{{ $item->passing_year,}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('education.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('education.destroy', $item->id) }}" method="POST">
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
                        @else
                            <tr>
                                <td colspan="5" style="text-align: center;"><h5>No Data Found</h5></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
@endsection
