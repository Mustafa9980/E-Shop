@extends('layouts.admin')

@section('title')
    Order
@endsection

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">Order View



                            <a class="btn btn-warning float-right " href="{{ url('orders') }}">Bake</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shippeing Details</h4>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border ">{{ $orders->fname }}</div>
                                <label for="">last Name</label>
                                <div class="border ">{{ $orders->lname }}</div>
                                <label for="">Email </label>
                                <div class="border ">{{ $orders->email }}</div>
                                <label for=""> Contact on</label>
                                <div class="border ">{{ $orders->phone }}</div>
                                <label for=""> Address</label>
                                <div class="border ">
                                    {{ $orders->address1 }} ,<br>
                                    {{ $orders->address2 }} ,<br>
                                    {{ $orders->city }},<br>
                                    {{ $orders->state }}
                                    {{ $orders->county }}
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border ">{{ $orders->pincode }}</div>


                            </div>

                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Number</th>
                                            <th> Quantity</th>
                                            <th> Price</th>
                                            <th> Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>

                                                    <img src="{{ asset('assets/uploads/products/' . $item->products->image) }}"
                                                        width="50px" alt="Product Image" />
                                                </td>




                                                {{-- <td>
                                                    <a href="{{ url('view-order/' . $item->id) }}"
                                                        class="btn btn-primary">View</a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>


                                </table>
                                <h4 class="px-2"> Grande Total:<span class="float-end">{{ $orders->total_price }}</span>
                                </h4>
                                <div class="mt-5 px-2">
                                    <label for="">Order status</label>
                                    <form action="{{url('update-order/'.$orders->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                    <select class="form-select" name="order_status">
                                        <option selected>Open this select menu</option>
                                        <option {{ $orders->status == '0' ? 'selected' : '' }}value="0">padding</option>
                                        <option {{ $orders->status == '1' ? 'selected' : '' }} value="1">completed
                                        </option>

                                    </select>
                                    <button type="submit" class="btn btn-primary float-end mt-2">Update</button>
                                </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
