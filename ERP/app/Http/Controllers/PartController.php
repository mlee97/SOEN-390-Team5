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
    //
    public function createPart(Request $request){

        $validator = Validator::make($request->all(), [
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $msg_str = 'Part creation failed';

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

       $newPart = Part::create([
            'part_name' => $request->part_name,
            'part_quantity_in_stock' => $request->part_quantity_in_stock,
        ]);

        $msg_str = 'New part with ID ' . $newPart->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Part has been successfully created!');
    }

    public function destroy($id, Request $request) {
        DB::delete('delete from parts where id = ?',[$id]);

        $msg_str = 'Part with ID '. $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect('/inventory')
            ->with('success_msg', 'Part Deleted');
     }

    public function editPart(Request $request) {

        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);

        if ($validator->fails()) {

            $msg_str = 'Updating part with ID '. $request->id . ' failed';
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


        $part = Part::find($request->id);
        $part->part_name = $request->part_name;
        $part->part_quantity_in_stock = $request->part_quantity_in_stock;

        $part->save();

        $msg_str = 'Part with ID '. $part->id. ' updated successfully';
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
