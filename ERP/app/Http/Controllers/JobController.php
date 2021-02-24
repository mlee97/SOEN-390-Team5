<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    // public function test() {
    //     $jobs = Job::all();

    //     return view('jobs', ['jobs' => $jobs]);
    // }

    public function createJob(Request $request){
        
        $request->validate([
            'status' => 'required',
        ]);

        Job::create([
            'status' => $request->status,
        ]);

        return redirect('/jobs')
        ->with('success_msg', 'Job has been successfully created!');
    }

    public function updateJobStatus($job_id){

        $status = Job::find($job_id);
     
        if($status->status == "Queued") {
            $status->status = "Complete";
        }
        else {
            $status->status = "Queued";
        }
     
        $status->save();

        return redirect()->route('jobs')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    public function goToCreateJob() {
        return view('create-job');
    }

    public function goToJobManagement(){

        $jobs = Job::all();

        return view('jobs', ['jobs' => $jobs]);
    }
}
