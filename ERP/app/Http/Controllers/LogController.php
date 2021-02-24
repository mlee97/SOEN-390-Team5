<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function goToLogManagement()
    {
        $logs = Log::all();
        return view('Logging.log-page', ['logs' => $logs]);
    }

}
