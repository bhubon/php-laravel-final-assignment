@extends('admin.admin-layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
                <div class="breadcrumb-title pe-3">Companies</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Companies</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex" style="justify-content: space-between;">
                        <div>
                            <h5 class="mb-0">All Companies</h5>
                        </div>
                        <div>
                            <form action="" method="GET" class="d-flex">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select</option>
                                    <option {{ request()->status == 'active' ? 'selected' : '' }} value="active">Active
                                    </option>
                                    <option {{ request()->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                        Inactive</option>
                                </select>
                                <button type="submit" class="btn btn-success mx-2">Filter</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Owner</th>
                                    <th>Status</th>
                                    <th>Registered At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($companies) > 0)
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>{{ $company->id }}</td>
                                            <td>{{ $company->company_name }}</td>
                                            <td><a href="">{{ $company->user->first_name }}
                                                    {{ $company->user->last_name }}</a></td>
                                            <td>{{ Str::ucfirst($company->user->status) }}</td>
                                            <td>{{ date('d M, Y', strtotime($company->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('companies.edit', $company->id) }}"
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
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
