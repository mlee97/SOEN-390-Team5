<!-- Modal button -->
<button type="button" class="btn btn-outline-info btn-lg" data-toggle="modal"
        data-target="#backlog-tables">Order Backlog
</button>

<!--
            modal for showing backlog table
         -->
<div class="modal fade" id="backlog-tables" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content shadow border border-dark">
            <!-- header of modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Backlog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <!-- body of modal -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="card text-center mt-4">
                        <!-- it holds the tabs -->
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <!-- tab for showing materials -->
                                    <a class="nav-link active" data-toggle="tab" href="#materials">Materials</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body tab-content">
                            <div class="tab-pane fade show active" id="materials">
                                <!-- real table for showing the materials -->
                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Estimated Arrival Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- LISTS OUT ALL THE ORDERS-->
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <button type="button" data-toggle="modal" class="btn btn-primary btn-sm"
                                                        data-target="#details{{$order->id}}"> {{$order->id}}
                                                </button>
                                            </td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->ETA}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--
    shows the backlog table of all the orders
-->
@foreach($orders as $order)
    <!-- Modal -->
    <div class="modal fade" id="details{{$order->id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-lg shadow-lg border border-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order {{$order->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                    <thead>
                        <th>Material</th>
                        <th>Quantity Ordered</th>
                        <th>Unit Cost</th>
                    </thead>
                    @foreach($order->materials as $mats)
                        <tr class>
                            <td>{{$mats->material_name}}</td>
                            <td>{{$mats->material_order_pivot->order_quantity}}</td>
                            <td>{{$mats->cost}}</td>
                        </tr>
                    @endforeach
                    </table>
                </div>
                <div class="modal-footer">
                    <div style="display:none"> {{$total_cost = 0}}</div>
                     @foreach($order->materials as $mats)
                        <div style="display:none">{{$total_cost = $total_cost + ($mats->cost)*($mats->material_order_pivot->order_quantity)}}</div>
                    @endforeach
                    <p class="lead">TOTAL COST: {{$total_cost}}$</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
