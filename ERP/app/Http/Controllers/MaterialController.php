<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
    * Creates a custom material as specified by the user from a form.
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
    public function createMaterial(Request $request){

        //Validate that all the following fields are specified and that they match their respective data type.
        $validator = Validator::make($request->all(), [
            'material_name' => 'required|string|max:255',
            'cost' => 'required',
            'material_quantity_in_stock' => 'required|integer',
        ]);

        //If the validation fails, log an error message.
        if ($validator->fails()) {
            $msg_str = 'Material creation failed';

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

        //Create a new material and associate each input with its appropriate field in the Material model.
        $newMaterial = Material::create([
            'material_name' => $request->material_name,
            'cost' => $request -> cost,
            'material_quantity_in_stock' => $request->material_quantity_in_stock,
        ]);

        $msg_str = 'New material with ID ' . $newMaterial->id. ' successfully created';

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
        ->with('success_msg', 'Material has been successfully created!'); //Send a temporary success message. This is saved in the session.
    }

    /**
    * Deletes the specified material from the materials table
    *
    * @param  $id       the id of the material to be deleted.
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
    public function destroy($id, Request $request) {

        //Find all parts associated with the material
        $partMaterialRelationship = DB::table('material_part')->where('material_id', '=', $id);


        if($partMaterialRelationship->count() == 0) {
            //Take the id parameter and insert it into the following query
            DB::delete('delete from materials where id = ?', [$id]);

            //Log the results of the post request
            $msg_str = 'Material with ID ' . $id . ' successfully deleted';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'INFO',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //Redirect the user to the inventory page
            return redirect('/inventory')
                ->with('success_msg', 'Material has been Successfully Deleted'); //Send a temporary success message. This is saved in the session
        } else {

            $msg_str = 'Failed to delete material with ID ' . $id. ' due to it being used by a part';
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);
            //Redirect the user to the inventory page with errors
            return redirect('/inventory')->withErrors(['This material can not be deleted since there is 1 or more part that is built using this material']);

        }
     }

    /**
    * Edits the specified material from the materials table
    *
    * @param  $request  stores the request method and its inputs, cookies, and files that were submitted with the request.
    * @return view      the inventory view.
    */
     public function editMaterial(Request $request) {

        //Validate that all the following fields are specified and that they match their respective data type.
         $validator = Validator::make($request->all(), [
             'id' => 'required|integer',
             'material_name' => 'required|string|max:255',
             'material_quantity_in_stock' => 'required|integer',
         ]);

         //If the validation fails, log an error message.
         if ($validator->fails()) {

             $msg_str = 'Updating material with ID '. $request->id . ' failed';

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

        //Find the specified material to update and update all of its fields.
        $material = Material::find($request->id);
        $material->material_name = $request->material_name;
        $material->material_quantity_in_stock = $request->material_quantity_in_stock;

        //Save this instance of the the Material Model.
        $material->save();

        //Log the results of the edit operation.
         $msg_str = 'Material with ID '. $material->id. ' updated successfully';
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
