<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}