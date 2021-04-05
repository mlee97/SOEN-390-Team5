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

/**
 * Display the machine status page
 *
 * @param $request
 * @return view
 */
public function goToMachineManagement(Request $request){

    $machines = Machine::all();

    //Log results
    $msg_str = 'Machine status management page accessed';
    Log::create([
        'user_id' => Auth::user()->id,
        'ip_address' => $request ->ip(),
        'log_type' => 'INFO',
        'request_type' => 'GET',
        'message' => $msg_str,
         ]);
    //Redirects user to machine-status page
    return view('machine-status', ['machines' => $machines]);
}

/**
 * Changes the status of the specific machine id
 *
 * @param $request, $id
 * @return redirect()->route('machine-status')
 */
public function changeStatus(Request $request,$id) {

    $machine = Machine::find($id);
    print($id);
    //If the machine is offline switch it to online and vice-versa
    if ($machine->status == "offline")
    {
        $machine->status = "online";
    }
    else
    {
        $machine->status = "offline";
    }

    $machine->save();

    //Log results
    $msg_str = 'Machine with ID '. $machine->id. ' changed status successfully';
    Log::create([
        'user_id' => Auth::user()->id,
        'ip_address' => $request ->ip(),
        'log_type' => 'INFO',
        'request_type' => 'POST',
        'message' => $msg_str,
    ]);

    //Redirects user to machine-status page
    return redirect('machine-status')
        ->with('success_msg', 'Changes have been successfully saved');
 }

}
