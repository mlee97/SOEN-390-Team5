<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use App\Models\Part;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
/**
 *  Takes care of the logics in the assembly view.
 */
class AssemblyController extends Controller
{
    // Redirects to the assembly view.
    public function goToAssemblyView(Request $request)
    {
        $bikes = Bike::all();
        $parts = Part::all();

        $materials = DB::table('material_part')
                        ->join('materials', 'material_part.material_id', '=', 'materials.id')
                        ->get();

        $msg_str = 'Assembly page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);

        return view('assembly', ['bikes' => $bikes, 'parts' => $parts, 'materials' => $materials]);
    }
}
