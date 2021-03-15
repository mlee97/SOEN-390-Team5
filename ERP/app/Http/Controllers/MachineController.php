<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Machine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class MachineController extends Controller
{

public function goToMachineManagement(Request $request){

    $machines = Machine::all();

    $msg_str = 'Machine status management page accessed';
    Log::create([
        'user_id' => Auth::user()->id,
        'ip_address' => $request ->ip(),
        'log_type' => 'INFO',
        'request_type' => 'GET',
        'message' => $msg_str,
         ]);
    return view('machine-status', ['machines' => $machines]);
}

public function changeStatus(Request $request,$id) {

    $machine = Machine::find($id);
    print($id);
    if ($machine->status == "offline")
    {
        $machine->status = "online";
    }
    else 
    {
        $machine->status = "offline";
    }

    $machine->save();

    $msg_str = 'Machine with ID '. $machine->id. ' changed status successfully';
    Log::create([
        'user_id' => Auth::user()->id,
        'ip_address' => $request ->ip(),
        'log_type' => 'INFO',
        'request_type' => 'POST',
        'message' => $msg_str,
    ]);
    
    return redirect()->route('machine-status')
        ->with('success_msg', 'Changes have been successfully saved');
 }

}