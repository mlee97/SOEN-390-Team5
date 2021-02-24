<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Part;

class PartController extends Controller
{
    //
    public function createPart(Request $request){
        
        $request->validate([
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);

        Part::create([
            'part_name' => $request->part_name,
            'part_quantity_in_stock' => $request->part_quantity_in_stock,
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Part has been successfully created!');
    }

    public function test(){

        error_log(request('type'));

        return redirect('/');
    }

    public function destroy($id) {
        DB::delete('delete from parts where id = ?',[$id]);
        return redirect('/inventory')
            ->with('success_msg', 'Part Deleted');
     }

    public function editPart(Request $request) {

        $request->validate([
            'id' => 'required|integer',
            'part_name' => 'required|string|max:255',
            'part_quantity_in_stock' => 'required|integer',
        ]);
        
        $part = Part::find($request->id);
        $part->part_name = $request->part_name;
        $part->part_quantity_in_stock = $request->part_quantity_in_stock;

        $part->save();

        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
     }
}
