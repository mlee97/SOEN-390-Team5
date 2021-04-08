<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Sale;

class SaleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        //labels is the x axis and dataset is the y axis
        $sales = Sale::all()->sortBy('created_at'); // Getting all data from Sale.    
        $labels = [];
        $dataset = [];
        //populates the axises with date as x axis and profit as y axis from sales tables in db
        foreach ($sales as $sale){
            array_push($labels,$sale->created_at);
            array_push($dataset,$sale->profit);
        }

        //creates the graph with chartisan
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $dataset);
    }
}