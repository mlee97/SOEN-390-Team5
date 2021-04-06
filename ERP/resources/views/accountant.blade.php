@extends('layouts.master')
@section('inside-body-tag')
    <div class="container-fluid">
        <div class="card text-center mt-4">
            
            <!--Card header-->
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all_sales">All Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#monthly_sales">Monthly Sales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#yearly_sales">Yearly Sales</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <span data-href="/sales-CSV-export" id="export" class="btn btn-primary btn-sm" onclick="exportToCSV(event.target);">Export into CSV</span>           
                    </li>
                    <li class="col-md-5" align="right">
                        <a href="{{ url('/sales-PDF-export') }}" target="_blank" class="btn btn-danger">Export into PDF</a>
                    </li>
                </ul>
            </div>
            
            <!--Card body-->
            <div class="card-body tab-content">

                <!--All sales tab-->
                <div class="tab-pane fade show active table-responsive" id="all_sales"> <!--"table-responsive" makes the table adjustable to window size-->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan = "2">Sales ID</th>
                                <th scope="col" colspan = "7">Bicycle Specifications</th>
                                <th scope="col" rowspan = "2">Quantity Sold</th>
                                <th scope="col" rowspan = "2">Date Sold</th>
                                <th scope="col" rowspan = "2">Profit (CAD)</th>
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
                    <table class="table table-bordered">                   
                        <tbody>
                            <th scope="col">Profit (CAD)</th>
                            <tr>
                                <td id="sale-chart-container" style="height: 300px;"></td>
                            </tr>   
                        </tbody>
                    </table>
                    <table class="table table-bordered">                   
                        <tbody>
                            <tr>
                                <th scope="col">Total Profit (CAD)</th>      

                                <td>{{$totalSalesProfit}}</td>
                            </tr>   
                        </tbody>
                    </table>
                </div>
                <!--End of all sales tab-->             

                <!--Monthly sales tab-->
                <div class="tab-pane fade" id="monthly_sales">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td align='left'><h3>This month's sales</h3></td> <!--Make the month dynamic--><!--Inline css (align='left'), for better practice, can be taken out into a css file-->
                                <td align='right'>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose a month</button>
                                        <div class="dropdown-menu">
                                            <!--Dummy values, make them dynamic in the future-->
                                            <a class="dropdown-item" href="#">{{$currentMonth}}/{{$currentYear}}</a>
                                            <a class="dropdown-item" href="#">{{$currentMonth-1}}/{{$currentYear}}</a>
                                            <a class="dropdown-item" href="#">{{$currentMonth-2}}/{{$currentYear}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan = "2">Sales ID</th>
                                <th scope="col" colspan = "7">Bicycle Specifications</th>
                                <th scope="col" rowspan = "2">Quantity Sold</th>
                                <th scope="col" rowspan = "2">Date Sold</th>
                                <th scope="col" rowspan = "2">Profit (CAD)</th>
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
                            <!--Dummy values, make them dynamic in the future-->
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>Mountain</td>
                                <td>24</td>
                                <td>Blue</td>
                                <td>Matt</td>
                                <td>Aluminium</td>
                                <td>150</td>
                                <td>1</td>
                                <td>2021-03-03 00:00:00</td>
                                <td>150</td>
                            </tr>    
                        </tbody>
                    </table>
                    <table class="table table-bordered">                   
                        <tbody>
                            <!--Dummy values, make them dynamic in the future-->
                            <tr>
                                <th scope="col">Total Profit (CAD)</th>      
                                <td>150</th>                
                            </tr>   
                        </tbody>
                    </table>
                </div>
                <!--End of monthly sales tab-->             

                <!--Yearly sales tab-->             
                <div class="tab-pane fade" id="yearly_sales">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td align='left'><h3>This year's sales</h3></td> <!--Make the year dynamic--><!--Inline css (align='left'), for better practice, can be taken out into a css file-->
                                <td align='right'>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose a year</button>
                                        <div class="dropdown-menu">
                                            <!--Dummy values, make them dynamic in the future-->
                                            <a class="dropdown-item" href="#">2020</a>
                                            <a class="dropdown-item" href="#">2019</a>
                                            <a class="dropdown-item" href="#">2018</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" rowspan = "2">Sales ID</th>
                                <th scope="col" colspan = "7">Bicycle Specifications</th>
                                <th scope="col" rowspan = "2">Quantity Sold</th>
                                <th scope="col" rowspan = "2">Date Sold</th>
                                <th scope="col" rowspan = "2">Profit (CAD)</th>
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
                            <!--Dummy values, make them dynamic in the future-->
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>Mountain</td>
                                <td>24</td>
                                <td>Blue</td>
                                <td>Matt</td>
                                <td>Aluminium</td>
                                <td>150</td>
                                <td>1</td>
                                <td>2021-06-03 00:00:00</td>
                                <td>150</td>
                            </tr>    
                        </tbody>
                    </table>
                    <table class="table table-bordered">                   
                        <tbody>
                            <!--Dummy values, make them dynamic in the future-->
                            <tr>
                                <th scope="col">Total Profit (CAD)</th>      
                                <td>150</th>                
                            </tr>   
                        </tbody>
                    </table>
                </div>
                <!--End of yearly sales tab-->             
            </div>
            <!--End of card body-->             
        </div>
    </div>

    <!--Js function for creating charts-->    
    <script>
      const chart = new Chartisan({
        el: '#sale-chart-container',
        url: "@chart('sale_chart')",
        hooks: new ChartisanHooks()
             .colors(['#4299E1','#FE0045','#C07EF1','#67C560','#ECC94B'])
                .datasets('line')
                .axis(true)
      });
    </script>
@endsection
