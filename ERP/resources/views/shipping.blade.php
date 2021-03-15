@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">SHIPPING</h1>
            <p>List of orders on backlog</p>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-10" id="orders">
                    <h3>Order Backlog</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">OrderID</th>
                            <th class="sort pointer-cursor" data-sort="status">ETA</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                            <th class="sort pointer-cursor" data-sort="status">Quantity</th>
                            <th class="sort pointer-cursor" data-sort="status">Operation</th>
                        </thead>
                        <tbody class="list">
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->ETA}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>{{$order->order_quantity}}</td>
                                    @if($order->status == 'received')
                                        <td>
                                            <a type="button" class="btn btn-danger" href="toggle-order-status/{{$order->id}}">Cancel Order</button>
                                        </td>
                                    @else
                                        <td>
                                            <a type="button" class="btn btn-success" href="toggle-order-status/{{$order->id}}">Receive Order</button>
                                        </td>
                                    @endif  
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