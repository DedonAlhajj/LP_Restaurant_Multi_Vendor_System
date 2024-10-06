@extends('admin.dashboard.master')
@section('title')
    Restaurant
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All customers</h4>
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
                                <th><strong>seller name</strong></th>
                             
                                <th><strong>seller resturant</strong></th>
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
                                        seller name</div>
                                    </td>
                                  
                                    <td>seller email</td>
                                    <td>  <a  class="btn btn-xs btn-danger" title=" show_retuarant"><i class="fas fa-eye"></i></a>

                                    </td>

                                    
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
                                {{-- end delete model --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
