<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class JobController extends Controller
{
    // public function test() {
    //     $jobs = Job::all();

    //     return view('jobs', ['jobs' => $jobs]);
    // }

    //creates a job with through a form
    public function createJob(Request $request){


        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        //what happens in the event that the bike creation fails
        if ($validator->fails()) {

            $msg_str = 'Job creation failed';
            //logs the event
            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            //redirects the user back to where the came from
            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();

        }

        //otherwise, creates and stores a job
        $newJob= Job::create([
            'status' => $request->status,
        ]);

        //logs the event
        $msg_str = 'Job with ID '. $newJob->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);


        //redirects the user to the jobs view with a successful message
        return redirect('/jobs')
        ->with('success_msg', 'Job has been successfully created!');
    }

    //deletes job from the jobs migration
    public function deleteJob($id, Request $request){

        $job = Job::find($id);
        $job->delete();

        //logs the action in the application
        $msg_str = 'Job with ID '. $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //return to the job view with sucess message
        return redirect()->route('jobs')
            ->with('success_msg', 'Job has been successfully deleted'); //Send a temporary success message. This is saved in the session
    }


    //The status attribute for jobs can be updated
    public function updateJobStatus($job_id, Request $request){

        $status = Job::find($job_id);

        //sets the job to completed, otherwise queued
        if($status->status == "Queued") {
            $status->status = "Complete";
        }
        else {
            $status->status = "Queued";
        }

        $status->save();

        //logs
        $msg_str = 'Job status with ID '. $status->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //redirects the user to the jobs page with a successful message
        return redirect()->route('jobs')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    //redirects the user to the create-job view
    public function goToCreateJob(Request $request) {

        //logs event and return the user to the create jobs page
        $msg_str = 'Job Creation page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        return view('create-job');
    }

    //redirects the user to the jobs view
    public function goToJobManagement(Request $request){

        $jobs = Job::all();
        $orders = Order::all();

        //logs event and returns view for jobs
        $msg_str = 'Job management page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        return view('jobs', ['jobs' => $jobs, 'orders' => $orders]);
    }
}
