@extends('admin.admin-layout')
@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Blog Category Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 mx-auto">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div>
                        </div>
                        <h5 class="mb-0 text-primary">Category Details</h5>
                    </div>
                    <hr>
                    @include('components.validatation')
                    <form class="row g-3" method="POST" action="{{ route('blog-category.update',$category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" placeholder="Enter Category Name" class="form-control"
                                id="name" value="{{ old('name', $category->name) }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
