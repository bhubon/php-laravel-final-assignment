@extends('admin.admin-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <h6 class="mb-0 text-uppercase">Edit {{ $page->title }} Page</h6>
            <hr>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Page Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('pages.update', $page->id) }}">
                        @csrf
                        @method('PUT')

                        @if ($page->title == 'Contact')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Company Address*</label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="10">{{ $page->address }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Company Phone*</label>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ $page->phone }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Company Email*</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Phone" value="{{ $page->email }}">
                                </div>
                            </div>
                        @elseif($page->title == 'About')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_mission" class="form-label">Company Mission*</label>
                                    <textarea name="company_mission" id="company_mission" class="form-control" cols="30" rows="10">{{ $page->company_mission }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_vision" class="form-label">Company Vision*</label>
                                    <textarea name="company_vision" id="company_vision" class="form-control" cols="30" rows="10">{{ $page->company_vission }}</textarea>
                                </div>
                            </div>
                        @endif




                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
