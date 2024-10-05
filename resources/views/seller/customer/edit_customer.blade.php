@extends('admin.dashboard.master')
@section('title')
    Restaurant
@endsection

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>erorr</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>
@endif
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">All Restaurant</h4>
        </div>
       
        <div class="card-body">
            <form method="post" action="{{ route('sub_categories.store') }}" >
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">customer Name</label>
                    <input type="text"name="subCategory_name" class="form-control" id="inputEmail4" placeholder="Retaurant Name">
                  </div>
              
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4"> customer phone number</label>
                    <input type="text"name="subCategory_name" class="form-control" id="inputEmail4" placeholder="Retaurant Name">
                  </div>
              
            
                
            
                
                
                
              
                <button type="submit" class="btn btn-primary">update customer</button>
              </form>  
        </div>
    </div>
</div>
@endsection