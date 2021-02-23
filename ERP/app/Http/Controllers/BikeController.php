<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;

class BikeController extends Controller
{
    //
    public function createBike(Request $request){
        
        $request->validate([
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
        ]);

        Bike::create([
            'type' => $request->first_name,
            'size' => $request->last_name,
            'color' => $request->email,
            'finish' => $request->user_type,
            'grade' => Hash::make($request->password),
            'quantity_in_stock' => Hash::make($request->password),
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Bike has been successfully created!');
    }

    public function updateBike(Request $request){

        $request->validate([
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
        ]);

        $bike = Bike::find($request->bike_id);
        $bike->type = $request->type;
        $bike->size = $request->size;
        $bike->color = $request->color;
        $bike->finish = $request->finish;
        $bike->grade = $request->grade;
        $bike->quantity_in_stock = $request->quantity_in_stock;

        $biker->save();

        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    public function test(){

        error_log(request('type'));

        return redirect('/');
    }
}
