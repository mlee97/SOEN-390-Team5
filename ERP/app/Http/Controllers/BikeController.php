<?php

namespace App\Http\Controllers;


use App\Http\Requests\Auth\LoginRequest;
use App\Models\Bike;
use App\Models\Log;
use App\Models\Order;
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
    /**
     * Creates a custom bicycle as specified by the user from a form.
     *
     * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
     * @return view      the inventory view.
     */
    public function createBike(Request $request)
    {

        //Validate that all the following fields are specified and that they match their respective data type.
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',

            'fork' => 'required|integer',
            'seatpost' => 'required|integer',
            'headset' => 'required|integer',
            'cranks' => 'required|integer',
            'pedals' => 'required|integer',
            'handlebar' => 'required|integer',
            'stem' => 'required|integer',
            'saddle' => 'required|integer',
            'brakes' => 'required|integer',
            'shock' => 'required|integer',
            'rim' => 'required|integer',
            'tire' => 'required|integer'
        ]);

        //If the validation fails, log an error message.
        if ($validator->fails()) {
            $msg_str = 'Bike creation failed';

            //Log results.
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect user back to the inventory page.
            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        //Create a new bike and associate each input with its appropriate field in the Bike model.
        $bike = Bike::create([
            'type' => $request->type,
            'size' => $request->size,
            'color' => $request->color,
            'price' => $request->price,
            'finish' => $request->finish,
            'grade' => $request->grade,
            'quantity_in_stock' => $request->quantity_in_stock,
        ]);

        $fork = Part::find($request->fork);
        $bike->parts()->save($fork);
        $seatpost = Part::find($request->seatpost);
        $bike->parts()->save($seatpost);
        $headset = Part::find($request->headset);
        $bike->parts()->save($headset);
        $cranks = Part::find($request->cranks);
        $bike->parts()->save($cranks);
        $pedals = Part::find($request->pedals);
        $bike->parts()->save($pedals);
        $handlebar = Part::find($request->handlebar);
        $bike->parts()->save($handlebar);
        $stem = Part::find($request->stem);
        $bike->parts()->save($stem);
        $saddle = Part::find($request->saddle);
        $bike->parts()->save($saddle);
        $brakes = Part::find($request->brakes);
        $bike->parts()->save($brakes);
        $shock = Part::find($request->shock);
        $bike->parts()->save($shock);
        $rim = Part::find($request->rim);
        $bike->parts()->save($rim);
        $tire = Part::find($request->tire);
        $bike->parts()->save($tire);

        $msg_str = 'New bicycle with ID ' . $bike->id . ' successfully created';

        //Log the results of the create operation.
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect the user to the inventory page.
        return redirect()->route('inventory')
            ->with('success_msg', 'Bike has been successfully created!'); //Send a temporary success message. This is saved in the session.
    }

    /**
     * Edits the specified bicycle from the bikes table
     *
     * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
     * @return view      the inventory view.
     */
    public function editBike(Request $request)
    {

        //Validate that all the following fields are specified and that they match their respective data type.
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'type' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'finish' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'quantity_in_stock' => 'required|integer',

            'fork' => 'required|integer',
            'seatpost' => 'required|integer',
            'headset' => 'required|integer',
            'cranks' => 'required|integer',
            'pedals' => 'required|integer',
            'handlebar' => 'required|integer',
            'stem' => 'required|integer',
            'saddle' => 'required|integer',
            'brakes' => 'required|integer',
            'shock' => 'required|integer',
            'rim' => 'required|integer',
            'tire' => 'required|integer'
        ]);

        //If the validation fails, log an error message.
        if ($validator->fails()) {
            $msg_str = 'Updating bicycle with ID ' . $request->id . ' failed';

            //Log results.
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect user back to the inventory page.
            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        //Find the specified bicycle to update and update all of its fields.
        $bike = Bike::find($request->id);
        $bike->type = $request->type;
        $bike->size = $request->size;
        $bike->color = $request->color;
        $bike->finish = $request->finish;
        $bike->grade = $request->grade;
        $bike->quantity_in_stock = $request->quantity_in_stock;

        //Save this instance of the the Bike Model.
        $bike->save();

        DB::delete('delete from bike_part where bike_id = ?', [$bike->id]);

        $fork = Part::find($request->fork);
        $bike->parts()->save($fork);
        $seatpost = Part::find($request->seatpost);
        $bike->parts()->save($seatpost);
        $headset = Part::find($request->headset);
        $bike->parts()->save($headset);
        $cranks = Part::find($request->cranks);
        $bike->parts()->save($cranks);
        $pedals = Part::find($request->pedals);
        $bike->parts()->save($pedals);
        $handlebar = Part::find($request->handlebar);
        $bike->parts()->save($handlebar);
        $stem = Part::find($request->stem);
        $bike->parts()->save($stem);
        $saddle = Part::find($request->saddle);
        $bike->parts()->save($saddle);
        $brakes = Part::find($request->brakes);
        $bike->parts()->save($brakes);
        $shock = Part::find($request->shock);
        $bike->parts()->save($shock);
        $rim = Part::find($request->rim);
        $bike->parts()->save($rim);
        $tire = Part::find($request->tire);
        $bike->parts()->save($tire);

        //Log the results of the edit operation.
        $msg_str = 'Bicycle with ID ' . $bike->id . ' updated successfully';

        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect the user to the inventory page.
        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session.
    }

    /**
     * Returns the inventory view after clicking on an Inventory button or after modifying a table on the Inventory page.
     *
     * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request
     * @return view      the inventory view and the updated values of each row of the Bikes, Parts, Materials tables.
     */
    public function goToInventory(Request $request)
    {
        //Store the data from the Bikes, Parts, and Materials tables into variables
        $bikes = Bike::all();
        $parts = Part::all();
        $materials = Material::all();
        $orders = Order::all();
        $categories = DB::table('parts')
                        ->select('category')
                        ->distinct()
                        ->get();
        $partmaterials = DB::table('material_part')
                        ->join('materials', 'material_part.material_id', '=', 'materials.id')
                        ->get();

        //Log the results of the get request
        $msg_str = 'Inventory page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);

        //Return the inventory page and an array of arrays containing the data from the bikes, parts, and materials tables.
        return view('inventory', [
            'bikes' => $bikes,
            'parts' => $parts,
            'materials' => $materials,
            'orders' => $orders,
            'categories' => $categories,
            'partmaterials' => $partmaterials
        ]);
    }

    /**
     * Deletes the specified bicycle from the bikes table
     *
     * @param  $id       the id of the bicycle to be deleted.
     * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
     * @return view      the inventory view.
     */
    public function destroy($id, Request $request)
    {

        //Take the id parameter and insert it into the following query
        DB::delete('delete from bikes where id = ?', [$id]);

        //Log the results of the post request
        $msg_str = 'Bicycle with ID ' . $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect the user to the inventory page
        return redirect('/inventory')
            ->with('success_msg', 'Bike Has Been Successfully Deleted'); //Send a temporary success message. This is saved in the session
    }

}