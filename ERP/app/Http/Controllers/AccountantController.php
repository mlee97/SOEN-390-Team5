<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Bike;
use App\Models\Order;
use App\Models\Material;
use PDF;
use Exception;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

/**
 *  Takes care of the logics in the accountant view.
 */
class AccountantController extends Controller
{
    // Redirects to the accountant view.
    public function goToAccoutantView(Request $request)
    {
        $sales = Sale::all(); // Getting all data from Sale.
        $orders = Order::all(); // Getting all data from Order.
        $materials = Material::all(); // Getting all data from Material.

        $totalSalesProfit = collect($sales)->sum('profit'); // Sums all values in the 'profit' colomn in the sales table.

        $currentMonth = now()->month;
        $currentYear = now()->year;

        $msg_str = 'Accountant page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);

        return view('accountant',
            [
                'sales' => $sales,
                'orders' => $orders,
                'materials' => $materials,
                'totalSalesProfit' => $totalSalesProfit,
                'currentMonth' => $currentMonth,
                'currentYear' => $currentYear
            ]
        );
    }

    //export the sales in csv
    public function exportSalesCSV(Request $request)
    {
        $fileName = 'sales'.date('Y_m_d_H_i_s').'.csv';
        $sales = Sale::all()->sortByDesc('created_at');

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
    
        $columns = array('Sale ID', 'ID', 'Type', 'Size', 'Color', 'Finish', 'Grade', 'Price', 'Quantity Sold', 'Date Sold', 'Profit');
    
        $callback = function() use($sales, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sales as $sale) {
                foreach ($sale->bikes as $bikeSale) {
                    $row['Sale ID']  = $sale->id;
                    $row['ID'] = $bikeSale->bike_sale_pivot->bike_id;
                    $row['Type'] = $bikeSale->type;
                    $row['Size']  = $bikeSale->size;
                    $row['Color']  = $bikeSale->color;
                    $row['Finish']  = $bikeSale->finish;
                    $row['Grade']  = $bikeSale->grade;
                    $row['Price']  = $bikeSale->price;
                    $row['Quantity Sold']  = $bikeSale->bike_sale_pivot->quantity_sold;
                    $row['Date Sold']  = $sale->created_at;
                    $row['Profit']  = $sale->profit;
                  
                    fputcsv($file, array($row['Sale ID'], $row['ID'], $row['Type'], $row['Size'], $row['Color'], $row['Finish'], $row['Grade'], $row['Price'], $row['Quantity Sold'], $row['Date Sold'], $row['Profit']));
                }
            }

            fclose($file);
        };

        $msg_str = 'Sales Accounting Reports exported as CSV with filename "' . $fileName . '"';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return response()->stream($callback, 200, $headers);

    }

    //function to convert sales to html
    function convert_sales_to_html()
    {
        //$sales: variable that returns all the sales in sale table and sorts them in descending order of created time
        $sales = Sale::all()->sortByDesc('created_at');

        //$output below defines a table in html format and identifies the header of each column 

        $output = '
        <h3 align="center">Sales in PDF format</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:1px;" width="5%">Sale ID</th>
        <th style="border: 1px solid; padding:1px;" width="10%">ID</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Type</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Size</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Color</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Finish</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Grade</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Price</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Quantity Sold</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Date Sold</th>
        <th style="border: 1px solid; padding:1px;" width="10%">Profit</th>
        </tr>
        ';

        //this fills each row of the table with the specified elements from the sales table in each respective column
        //nested foreach with bikes as well to define what element from the bikes table will be put in each column for each sale
        foreach($sales as $sale) {
                foreach ($sale->bikes as $bikeSale) {
                $output .= '
                <tr>
                <td style="border: 1px solid; padding:1px;">'.$sale->id.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->bike_sale_pivot->bike_id.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->type.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->size.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->color.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->finish.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->grade.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->price.'</td>
                <td style="border: 1px solid; padding:1px;">'.$bikeSale->bike_sale_pivot->quantity_sold.'</td>
                <td style="border: 1px solid; padding:1px;">'.$sale->created_at.'</td>
                <td style="border: 1px solid; padding:1px;">'.$sale->profit.'</td>
                </tr>
                ';
                }
            }

        //this returns the table
        $output .= '</table>';
        return $output;
    }

    //pdf function to converts the html table above to pdf using a PDF plugin called domPDF that was added with composer 
    //$pdf will first make a pdf '$pdf = \App::make('dompdf.wrapper');', then use the conversion function above '$pdf-> loadHTML($this->convert_sales_to_html());' for the content in the PDF
    //and finally return the pdf 'return $pdf->stream();'
    function exportSalesPDF(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_sales_to_html());
        $fileName = 'sales'.date('Y_m_d_H_i_s').'.pdf';
      
        $msg_str = 'Sales Accounting Reports exported as PDF with filename "' . $fileName . '"';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);
      
        return $pdf->download($fileName);
    }

    //export the orders in csv
    public function exportOrdersCSV(Request $request)
    {
        $fileName = 'orders'.date('Y_m_d_H_i_s').'.csv';
        $orders = Order::all()->sortByDesc('created_at');
    
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
    
        $columns = array('Order ID', 'Material', 'Quantity Ordered', 'Unit Cost', 'Order Cost');
    
        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($orders as $order) {
                foreach ($order->materials as $mats) {
                    $row['Order ID']  = $order->id;
                    $row['Material'] = $mats->material_name;
                    $row['Quantity Ordered'] = $mats->material_order_pivot->order_quantity;
                    $row['Unit Cost']  = $mats->cost;
                    $row['Order Cost']  = $order_cost = ($mats->cost)*($mats->material_order_pivot->order_quantity);
    
                    fputcsv($file, array($row['Order ID'], $row['Material'], $row['Quantity Ordered'], $row['Unit Cost'], $row['Order Cost']));
                }
            }
            fclose($file);
        };

        $msg_str = 'Orders Accounting Reports exported as CSV with filename "' . $fileName . '"';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return response()->stream($callback, 200, $headers);
    }

    //function to convert orders to html
    function convert_orders_to_html()
    {
        //$orders: variable that returns all the orders in order table and sorts them in descending order of created time
        $orders = Order::all()->sortByDesc('created_at');

        //$output below defines a table in html format and identifies the header of each column 
        $output = '
        <h3 align="center">Orders in PDF format</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:1px;" width="20%">Order ID</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Material</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Quantity Ordered</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Unit Cost</th>
        <th style="border: 1px solid; padding:1px;" width="20%">Order Cost</th>
        </tr>
        ';  

        //this fills each row of the table with the specified elements from the orders table in each respective column
        //nested foreach with materials as well to define what element from the materials table will be put in each column for each order
        foreach($orders as $order) {
                foreach ($order->materials as $mats) {
                $output .= '
                <tr>
                <td style="border: 1px solid; padding:1px;">'.$order->id.'</td>
                <td style="border: 1px solid; padding:1px;">'.$mats->material_name.'</td>
                <td style="border: 1px solid; padding:1px;">'.$mats->material_order_pivot->order_quantity.'</td>
                <td style="border: 1px solid; padding:1px;">'.$mats->cost.'</td>
                <td style="border: 1px solid; padding:1px;">'.$order_cost = ($mats->cost)*($mats->material_order_pivot->order_quantity).'</td>
                </tr>
                ';
                }
            }
        //this returns the table
        $output .= '</table>';
        return $output;
    }  

    //pdf function to converts the html table above to pdf using a PDF plugin called domPDF that was added with composer 
    //$pdf will first make a pdf '$pdf = \App::make('dompdf.wrapper');', then use the conversion function above '$pdf-> loadHTML($this->convert_orders_to_html());' for the content in the PDF
    //and finally return the pdf 'return $pdf->stream();'
    function exportOrdersPDF()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_orders_to_html());
        $fileName = 'orders'.date('Y_m_d_H_i_s').'.pdf';

        $msg_str = 'Orders Accounting Reports exported as PDF with filename "' . $fileName . '"';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return $pdf->download($fileName);
    }    
}
