@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">

            <h4>Products Page</h4>
            <hr>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
            <thead>
                    <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                
                </tr>
            </thead>
            <tbody>
               @foreach ($products as $item)
                   
             
                <tr>
                 <td>{{ $item->id }}</td>
                 <td>{{ $item->category->name }}</td>
                 <td>{{ $item->name }}</td>
                 <td>{{ $item->selling_price }} R.S</td>
            
                 
                 <td>
                <img src="{{asset('assets/uploads/products/'.  $item->image)}}" style="width:90px; height:80px"  alt="Image her">
                
                </td>
                 <td>
                    <a href="{{ url('edit-prod/'. $item->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('delete-product/'. $item->id) }}" class="btn btn-danger">Delete</a>

                   
                </td>

                </tr>
                @endforeach
            </tbody>


            </table>
        </div>
    </div>
@endsection
