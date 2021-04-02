<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Part;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PartController extends Controller
{
    /**
    * Creates a custom part as specified by the user from a form.
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
    public function createPart(Request $request){

        //Validate that all the following fields are specified and that they match their respective data type.
        $validator = Validator::make($request->all(), [
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);

        //If the validation fails, log an error message.
        if ($validator->fails()) {
            $msg_str = 'Part creation failed';

            //Log results.
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect user back to the inventory page.
            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        //Create a new part and associate each input with its appropriate field in the Part model.
       $newPart = Part::create([
            'part_name' => $request->part_name,
            'part_quantity_in_stock' => $request->part_quantity_in_stock,
        ]);

        $msg_str = 'New part with ID ' . $newPart->id. ' successfully created';

        //Log the results of the create operation.
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect the user to the inventory page.
        return redirect()->route('inventory')
        ->with('success_msg', 'Part has been successfully created!'); //Send a temporary success message. This is saved in the session.
    }

    /**
    * Deletes the specified part from the parts table
    *
    * @param  $id       the id of the part to be deleted.
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
    public function destroy($id, Request $request) {

        //Find all bikes associated with part
        $bikePartRelationship = DB::table('bike_part')->where('part_id', '=', $id);

        //If part is associated with a bike, the delete operation fails
        if($bikePartRelationship->count() == 0) {

            //Take the id parameter and insert it into the following query
            DB::delete('delete from parts where id = ?', [$id]);

            //Log the results of the post request
            $msg_str = 'Part with ID ' . $id . ' successfully deleted';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'INFO',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect the user to the inventory page
            return redirect('/inventory')
                ->with('success_msg', 'Part Has Been Successfully Deleted'); //Send a temporary success message. This is saved in the session
        } else {


            //Log the results of the failed post request
            $msg_str = 'Failed to delete Part with ID ' . $id. ' Due to It Being Used by a Bike';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);
            //Redirect the user to the inventory page with errors
            return redirect('/inventory')->withErrors(['This Part can not Be Deleted since there is 1 or more Bike that is Built Using this Part']);

        }
     }

    /**
    * Edits the specified part from the parts table
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
    public function editPart(Request $request) {

        //Validate that all the following fields are specified and that they match their respective data type.
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);

        //If the validation fails, log an error message.
        if ($validator->fails()) {

            $msg_str = 'Updating part with ID '. $request->id . ' failed';

            //Log results.
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect user back to the inventory page.
            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();
        }

        //Find the specified part to update and update all of its fields.
        $part = Part::find($request->id);
        $part->part_name = $request->part_name;
        $part->part_quantity_in_stock = $request->part_quantity_in_stock;

        //Save this instance of the the Part Model.
        $part->save();

        //Log the results of the edit operation.
        $msg_str = 'Part with ID '. $part->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect the user to the inventory page.
        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
     }
}
