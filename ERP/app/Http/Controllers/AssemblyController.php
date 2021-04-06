<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Part;
use Illuminate\Support\Facades\DB;

/**
 *  Takes care of the logics in the accountant view.
 */
class AssemblyController extends Controller
{
    // Redirects to the accountant view.
    public function goToAssemblyView()
    {
        $bikes = Bike::all();
        $parts = Part::all();

        $materials = DB::table('material_part')
                        ->join('materials', 'material_part.material_id', '=', 'materials.id')
                        ->get();

        return view('assembly', ['bikes' => $bikes, 'parts' => $parts, 'materials' => $materials]);
    }
}