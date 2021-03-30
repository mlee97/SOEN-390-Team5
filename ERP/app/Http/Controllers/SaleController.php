<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Sale;
use PDF;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //export the sales in csv
    public function exportSales(Request $request){

    $fileName = 'sales'.date('Y_m_d_H_i_s').'.csv';
    $sales = Sale::all()->sortByDesc('created_at');

    $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    $columns = array('Sales ID', 'ID', 'Type', 'Size', 'Color', 'Finish', 'Grade', 'Price', 'Quantity Sold', 'Date Sold', 'Profit');

    $callback = function() use($sales, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($sales as $sale) {
            foreach ($sale->bikes as $bikeSale) {
                $row['Sales ID']  = $sale->id;
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

                fputcsv($file, array($row['Sales ID'], $row['ID'], $row['Type'], $row['Size'], $row['Color'], $row['Finish'], $row['Grade'], $row['Price'], $row['Quantity Sold'], $row['Date Sold'], $row['Profit']));
            }
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);

    } 

    //function to convert sales to html
    function convert_sales_to_html()
    {
        $sales = Sale::all()->sortByDesc('created_at');

        $output = '
        <h3 align="center">Sales in PDF format</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <th style="border: 1px solid; padding:1px;" width="5%">Sales ID</th>
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

        $output .= '</table>';
        return $output;
    }  

    //pdf function to convert html to pdf
    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_sales_to_html());
        return $pdf->stream();
    }
}
