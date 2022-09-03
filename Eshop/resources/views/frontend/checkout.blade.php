@extends('layouts.front')

@section('title')
    Welcome to E-shop
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-6">
                <a href="{{ url('/') }}">home</a>/
                <a href="{{ url('checkout') }}">Checkout</a>


            </h6>
        </div>
    </div>
    <div class="container mt-5 ">
        <form action="{{ url('place-order') }} " method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->name }}"  name="fname" placeholder="Enter First">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->lname }}"  name="lname"  placeholder="Enter Last Nane">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" value="{{ Auth::user()->email }}"  name="email"  placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="phone" placeholder="Enter Phone Number">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 1</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address1 }}" name="Address1" placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Address 2</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->address1 }}" name="Address2" placeholder="Enter Address 2">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->city }}" name="city" placeholder="Enter City">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">state</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->state }}" name="state" placeholder="Enter state" >
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->county }}" name="county" placeholder="Enter Country" >
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Pin cod</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Enter Pin cod" >
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        @if ($cartitems->count()>0)

                        <div class="card-body">
                            <h6>Order Details </h6>
                            <hr>
                            @php
                                $total = 0;
                            @endphp

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartitems as $item)
                                        <tr>
                                            <td>{{ $item->products->name }}</td>
                                            <td>{{ $item->prod_qty }}</td>
                                            <td>{{ $item->products->selling_price }}</td>
                                            @php    $total +=$item->products->selling_price * $item->prod_qty   @endphp

                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td>Total</td>

                                        <td  colspan="2">{{$total}}</td>
                                        {{-- <input type="hidden" name="" value="{{$total}}"> --}}

                                    </tr>
                                </tbody>


                            </table>
                            <hr>
                            <button type="submit" class="btn btn-primary w-100"> Place Order</button>
                        </div>

                        @else

                        <h1>No product in Cart</h1>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
