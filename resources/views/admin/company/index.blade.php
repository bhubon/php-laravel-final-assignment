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
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">All Companies</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Order id</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($companies) > 0)
                                    <tr>
                                        <td>#897656</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="assets/images/icons/chair.png" alt="">
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Light Blue Chair</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Brooklyn Zeo</td>
                                        <td>12 Jul 2020</td>
                                        <td>$64.00</td>
                                        <td>
                                            <div class="d-flex align-items-center text-danger"> <i
                                                    class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                                <span>Pending</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions"> <a href="javascript:;" class=""><i
                                                        class="bx bx-cog"></i></a>
                                                <a href="javascript:;" class="ms-4"><i
                                                        class="bx bx-down-arrow-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="7"><h6 class="text-center my-4">No Data Found</h6></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
