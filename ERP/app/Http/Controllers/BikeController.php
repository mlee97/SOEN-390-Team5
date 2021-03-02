<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\Bike;
use App\Models\Log;
use App\Models\Part;
use App\Models\Material;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BikeController extends Controller
{
    //
    public function createBike(Request $request){

        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $msg_str = 'Bike creation failed';

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        $newBike = Bike::create([
            'type' => $request->type,
            'size' => $request->size,
            'color' => $request->color,
            'finish' => $request->finish,
            'grade' => $request->grade,
            'quantity_in_stock' => $request->quantity_in_stock,
        ]);

        $msg_str = 'New bicycle with ID '. $newBike->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Bike has been successfully created!');
    }


    public function editBike(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $msg_str = 'Updating bicycle with ID '. $request->id. ' failed';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        $bike = Bike::find($request->id);
        $bike->type = $request->type;
        $bike->size = $request->size;
        $bike->color = $request->color;
        $bike->finish = $request->finish;
        $bike->grade = $request->grade;
        $bike->quantity_in_stock = $request->quantity_in_stock;

        $bike->save();

        $msg_str = 'Bicycle with ID '. $bike->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
     }

    public function goToInventory(Request $request)
    {
        $bikes = Bike::all();
        $parts = Part::all();
        $materials = Material::all();

        $msg_str = 'Inventory page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        return view('inventory', ['bikes' => $bikes, 'parts' => $parts, 'materials' => $materials]);
    }

     public function destroy($id, Request $request) {
        DB::delete('delete from bikes where id = ?',[$id]);

         $msg_str = 'Bicycle with ID '. $id . ' successfully deleted';
         Log::create([
             'user_id' => Auth::user()->id,
             'ip_address' => $request ->ip(),
             'log_type' => 'INFO',
             'request_type' => 'POST',
             'message' => $msg_str,
         ]);
        return redirect('/inventory')
            ->with('success_msg', 'Bike Deleted');
     }

}
