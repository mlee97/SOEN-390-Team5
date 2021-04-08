<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Material;

class OrderChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        //labels is the x axis and dataset is the y axis
        $orders = Order::all()->sortBy('created_at'); // Getting all data from Order.    
        $labels = [];
        $dataset = [];
        //populates the axises with date as x axis and profit as y axis from order and material tables in db
        foreach ($orders as $order){
            foreach($order->materials as $mats){
                $order_cost = ($mats->cost)*($mats->material_order_pivot->order_quantity);
                array_push($labels,$order->created_at);
                array_push($dataset,$order_cost);
            }
        }

        //creates the graph with chartisan
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample', $dataset);
    }
}