<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\Bike;
use App\Models\Part;
use App\Models\Material;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'type' => $request->type,
            'size' => $request->size,
            'color' => $request->color,
            'finish' => $request->finish,
            'grade' => $request->grade,
            'quantity_in_stock' => $request->quantity_in_stock,
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

    public function goToInventory()
    {
        $bikes = Bike::all();
        $parts = Part::all();
        $materials = Material::all();
        return view('inventory', ['bikes' => $bikes, 'parts' => $parts, 'materials' => $materials]);
    }

}
