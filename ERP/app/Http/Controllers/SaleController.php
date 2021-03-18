<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Sale;

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
}
