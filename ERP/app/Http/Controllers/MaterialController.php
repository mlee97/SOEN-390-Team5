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
    //
    public function createMaterial(Request $request){

        $validator = Validator::make($request->all(), [
            'material_name' => 'required|string|max:255',
            'material_quantity_in_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $msg_str = 'Material creation failed';

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

        $newMaterial = Material::create([
            'material_name' => $request->material_name,
            'material_quantity_in_stock' => $request->material_quantity_in_stock,
        ]);

        $msg_str = 'New material with ID ' . $newMaterial->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Material has been successfully created!');
    }


    public function destroy($id, Request $request) {
        DB::delete('delete from materials where id = ?',[$id]);

        $msg_str = 'Material with ID '. $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);
        return redirect('/inventory')
            ->with('success_msg', 'Material Deleted');
     }

     public function editMaterial(Request $request) {

         $validator = Validator::make($request->all(), [
             'id' => 'required|integer',
             'material_name' => 'required|string|max:255',
             'material_quantity_in_stock' => 'required|integer',
         ]);

         if ($validator->fails()) {

             $msg_str = 'Updating material with ID '. $request->id . ' failed';
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

        $material = Material::find($request->id);
        $material->material_name = $request->material_name;
        $material->material_quantity_in_stock = $request->material_quantity_in_stock;

        $material->save();

         $msg_str = 'Material with ID '. $material->id. ' updated successfully';
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
}
