<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    //
    public function createJob(Request $request){
        
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        Job::create([
            'status' => $request->status,
        ]);

        return redirect()->route('job')
        ->with('success_msg', 'Job has been successfully created!');
    }

    public function updateJob(Request $request){

        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $status = Job::find($request->job_id);
        $status->status = $request->status;

        $status->save();

        return redirect()->route('job')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    public function test(){

        error_log(request('type'));

        return redirect('/');
    }
}
