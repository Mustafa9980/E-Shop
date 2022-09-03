@extends('layouts.admin')

@section('title')
    New Order
@endsection

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4>New order</h4>
                        <a class="btn btn-warning float-right " href="{{ url('orders-history') }}">Order History</a>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Tracking Number</th>
                                    <th> Total price</th>
                                    <th> Status</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{date('d-m-Y',strtotime($item->tracking_no)) }}</td>
                                        <td>{{ $item->total_price }}</td>                                      
                                        <td>{{ $item->status=='0' ?'pending':'completed' }}</td>

                                        <td>
                                            <a href="{{ url('Admin/view-order/'.$item->id) }}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
