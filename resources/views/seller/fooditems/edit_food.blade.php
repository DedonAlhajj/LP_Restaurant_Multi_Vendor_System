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
            <form method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Name</label>
                    <input type="text"name="name" class="form-control" id="inputEmail4" placeholder="Retaurant Name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">description</label>
                    <input type="number" class="form-control" name="description" id="inputPassword4" placeholder="whatsapp_number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text"  name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <label for="inputAddress2">price</label>
                  <input type="number" name="price" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">resturant</label>
                    <select name="restaurant_id" class="default-select form-control wide mb-3">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3" >3</option>
                        <option value="4">4</option>
                    
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Category</label>
                    <select name="subcategory_id" class="default-select form-control wide mb-3">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3" >3</option>
                      
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputZip">logo</label>
          
                        <input type="file"name="image" class="form-file-input form-control">
                 
                </div>
                
               
                
              
                <button type="submit" class="btn btn-primary">create Restaurant</button>
              </form>  
        </div>
    </div>
</div>
@endsection