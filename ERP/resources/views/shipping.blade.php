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
                    <div class="col" id="orders">
                        <h3>Order Backlog</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">OrderID</th>
                            <th class="sort pointer-cursor" data-sort="status">ETA</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                            <th class="sort pointer-cursor" data-sort="status">Operation</th>
                            </thead>
                            <tbody class="list">
                            @foreach($orders as $order)
                            @if($order->status != "Received")
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->ETA}}</td>
                                    <td>{{$order->status}}</td>

                                    <td>
                                        <form action="{{route('mark.received')}}" method="POST">
                                            <input id="orderID" name="orderID" type="hidden" value="{{$order->id}}">
                                            <button type="submit" class="btn btn-success">Mark as Received</button>
                                            {{csrf_field()}}
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#order{{$order->id}}">Order Details
                                        </button>
                                        </form>
                                    </td>
                                </tr>

                                @endif

                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                @foreach($orders as $order)
                @if($order->status != "Received")
                <!-- Modal -->
                    <div class="modal fade" id="order{{$order->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order ID #{{$order->id}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Material Name</th>
                                            <th scope="col">Quantity Ordered</th>
                                            <th scope="col">Unit Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->materials as $mats)
                                            <tr class>
                                                <td>{{$mats->material_name}}</td>
                                                <td>{{$mats->material_order_pivot->order_quantity}}</td>
                                                <td>{{$mats->cost}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <div style="display:none"> {{$total_cost = 0}}</div>
                                    @foreach($order->materials as $mats)
                                        <div
                                            style="display:none">{{$total_cost = $total_cost + ($mats->cost)*($mats->material_order_pivot->order_quantity)}}</div>
                                    @endforeach
                                    <p class="lead">TOTAL COST: {{$total_cost}}$</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <br>

            <div class="row">
                    <div class="col">
                        <h3>Order History</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">OrderID</th>
                            <th class="sort pointer-cursor" data-sort="status">ETA</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                            <th class="sort pointer-cursor" data-sort="status">Operation</th>
                            </thead>
                            <tbody class="list">
                            @foreach($orders as $order)
                            @if($order->status == "Received")
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->ETA}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#order{{$order->id}}">Order Details
                                        </button>
                                    </td>

                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                @foreach($orders as $order)
                @if($order->status == "Received")
                <!-- Modal -->
                    <div class="modal fade" id="order{{$order->id}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order ID #{{$order->id}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless">
                                        <thead>
                                        <tr>
                                            <th scope="col">Material Name</th>
                                            <th scope="col">Quantity Ordered</th>
                                            <th scope="col">Unit Cost</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->materials as $mats)
                                            <tr class>
                                                <td>{{$mats->material_name}}</td>
                                                <td>{{$mats->material_order_pivot->order_quantity}}</td>
                                                <td>{{$mats->cost}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <div style="display:none"> {{$total_cost = 0}}</div>
                                    @foreach($order->materials as $mats)
                                        <div
                                            style="display:none">{{$total_cost = $total_cost + ($mats->cost)*($mats->material_order_pivot->order_quantity)}}</div>
                                    @endforeach
                                    <p class="lead">TOTAL COST: {{$total_cost}}$</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

@endsection
