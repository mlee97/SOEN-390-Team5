<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    //
    public function createMaterial(Request $request){
        
        $request->validate([
            'material_name' => 'required|string|max:255',
            'material_quantity_in_stock' => 'required|integer',
        ]);

        Material::create([
            'material_name' => $request->material_name,
            'material_quantity_in_stock' => $request->material_quantity_in_stock,
        ]);

        return redirect()->route('inventory')
        ->with('success_msg', 'Material has been successfully created!');
    }

    public function updateMaterial(Request $request){

        $request->validate([
            'material_name' => 'required|string|max:255',
            'material_quantity_in_stock' => 'required|integer',
        ]);

        $material = Material::find($request->material_id);
        $material->name = $request->material_name;
        $material->material_quantity_in_stock = $request->material_quantity_in_stock;

        $biker->save();

        return redirect()->route('inventory')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    public function test(){

        error_log(request('type'));

        return redirect('/');
    }

    public function destroy($id) {
        DB::delete('delete from materials where id = ?',[$id]);
        return redirect('/inventory')
            ->with('success_msg', 'Material Deleted');
     }
}
