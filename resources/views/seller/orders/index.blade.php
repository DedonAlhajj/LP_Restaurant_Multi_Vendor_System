@extends('admin.dashboard.master')
@section('title')
    Restaurant
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Restaurant</h4>
                <a href="" class="btn btn-primary">Create Resturant</a>
            </div>

            <div >
                @include('massages_alert')

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:50px;">
                                    <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>ROLL NO.</strong></th>
                                <th><strong>customer</strong></th>
                                <th><strong>restaurant</strong></th>
                                <th><strong>status</strong></th>
                                <th><strong>total_price</strong></th>
                                <th><strong>payment_status</strong></th>
                                <th><strong>order_types</strong></th>
                                <th><strong>payment_method</strong></th>
                                <th><strong>processes</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheckBox2"
                                                required="">
                                            <label class="custom-control-label" for="customCheckBox2"></label>
                                        </div>
                                    </td>
                                    <td><strong>1</strong></td>
                                    <td>
                                        customer</div>
                                    </td>
                                    <td>restaurant </td>
                                    <td></td>
                                    <td>status</td>

                                    <td>total_price</td>
                                    <td>payment_status</td>
                                    <td>order_types</td>
                                    <td>payment_method</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href=""
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                                    <button  class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#Deleted"><i class="fas fa-trash"></i></button>
                                                    <button  class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#edit_order_status"><i class="fas fa-trash"></i></button>

                                        </div>
                                    </td>
                                </tr>


                                {{-- delete model --}}
                                @include('seller.orders.edit_order')
                                {{-- end delete model --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
