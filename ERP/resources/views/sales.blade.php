@extends('layouts.master')
@section('inside-body-tag')
<div class="container-fluid table-responsive"> <!--"table-responsive" makes the table adjustable to window size-->
    <!-- table for showing all the sales  -->
    <div class="table-responsive">
    <table class="table table-bordered text-center mt-5"> <!-- mt-5 is for adding margin top -->

        <thead>
            <tr>
                <th scope="col" rowspan="2">Sales ID</th>
                <th scope="col" class="text-center" colspan="7">Bicycle Specifications</th>
                <th scope="col" rowspan="2">Quantity Sold</th>
                <th scope="col" rowspan="2">Date Sold</th>
                <th scope="col" rowspan="2">Profit (CAD)</th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Type</th>
                <th scope="col">Size</th>
                <th scope="col">Color</th>
                <th scope="col">Finish</th>
                <th scope="col">Grade</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                @foreach ($sale->bikes as $bikeSale)
                <tr>
                    <td>{{$sale->id}}</td>

                    <td>{{$bikeSale->bike_sale_pivot->bike_id}}</td> <!--We need to use bike_sale_pivot to get the bike_id in the bike_sale table-->
                    <td>{{$bikeSale->type}}</td>
                    <td>{{$bikeSale->size}}</td>
                    <td>{{$bikeSale->color}}</td>
                    <td>{{$bikeSale->finish}}</td>
                    <td>{{$bikeSale->grade}}</td>
                    <td>{{$bikeSale->price}}</td>

                    <td>{{$bikeSale->bike_sale_pivot->quantity_sold}}</td>
                    <td>{{$sale->created_at}}</td>
                    <td>{{$sale->profit}}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sales_modal">
        Add Sales
    </button>

    <!-- Modal the popup when click to add or edit an Sales Order -->
    <div class="modal fade" id="sales_modal" tabindex="-1" role="dialog" aria-labelledby="sales_modal_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sales_modal_label">Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal body for the input -->
                    <form method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="bicycle_id">Bicycles</label>
                            <!-- the dropdown list for showing the bicycles -->
                            <select id="bicycle_id" name="bicycleId">
                                @foreach ($bicycles as $bicycle)
                                <option value="{{$bicycle->id}}">
                                    {{$bicycle->type}}-
                                    {{$bicycle->price}}-
                                    {{$bicycle->size}}-
                                    {{$bicycle->color}}-
                                    {{$bicycle->finish}}-
                                    {{$bicycle->grade}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bicyle_quantity_sold_input">Quantity Sold</label>
                            <input id="bicyle_quantity_sold_input" type="text" name="quantitySold" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <label for="bicyle_profit_input">Profit</label>
                            <input id="bicyle_profit_input" type="text" name="profit" class="form-control" placeholder="Profit">
                        </div>
                        <!-- End of Modal body for input -->
                </div>
                <div class="modal-footer">
                    <!-- Modal or Popup footer -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of the Sales Orders modal -->
</div>
@endsection