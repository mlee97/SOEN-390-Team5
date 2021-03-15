<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\RequiredIf;

class JobController extends Controller
{
    /**
     * Creates a job and returns to inventory if validation fail and jobs if validation succeed
     * 
     * @param $request
     * @return redirect()->route('inventory') or redirect('/jobs')
     */
    public function createJob(Request $request){


        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        //If validatin fails user is redirected to inventory
        if ($validator->fails()) {

            $msg_str = 'Job creation failed';

            Log::create([
                'user_id' => Auth::user()->id,
                'ip_address' => $request ->ip(),
                'log_type' => 'ERROR',
                'request_type' => 'POST',
                'message' => $msg_str,
            ]);

            return redirect()->route('inventory')
                ->withErrors($validator)
                ->withInput();

        }

        //Otherwise successfully create a job 
        $newJob= Job::create([
            'status' => $request->status,
        ]);

        //Log results
        $msg_str = 'Job bicycle with ID '. $newJob->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect user to jobs page
        return redirect('/jobs')
        ->with('success_msg', 'Job has been successfully created!');
    }

    /**
     * Delete specific job id
     * 
     * @param $id, $request 
     * @return redirect()->route('jobs')
     */
    public function deleteJob($id, Request $request){

        //Find specific job id and delete it
        $job = Job::find($id);
        $job->delete();

        //Log results
        $msg_str = 'Job with ID '. $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect user to jobs page
        return redirect()->route('jobs')
            ->with('success_msg', 'Job has been successfully deleted'); //Send a temporary success message. This is saved in the session
    }

    /**
     * Update job status of specific job id
     * 
     * @param $job_id, $request
     * @return redirect()->route('jobs')
     */
    public function updateJobStatus($job_id, Request $request){

        //Find status of job id
        $status = Job::find($job_id);

        //If job status id queued, change to complete and vice-versa
        if($status->status == "Queued") {
            $status->status = "Complete";
        }
        else {
            $status->status = "Queued";
        }

        //Save the status of job id
        $status->save();

        //Log results
        $msg_str = 'Job status with ID '. $status->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        //Redirect user to jobs page
        return redirect()->route('jobs')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    /**
     * Go to create-job form to create job
     * 
     * @param $request
     * @return view
     */
    public function goToCreateJob(Request $request) {

        //Get results
        $msg_str = 'Job Creation page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);

        //Redirect user to create-job page
        return view('create-job');
    }

    /**
     * Go to job management page and return list of jobs
     * 
     * @param $request
     * @return view
     */
    public function goToJobManagement(Request $request){

        //Retrieve job model
        $jobs = Job::all();

        //Get results
        $msg_str = 'Job management page accessed';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'GET',
            'message' => $msg_str,
        ]);
        
        //Redirect user to jobs page and returns jobs list
        return view('jobs', ['jobs' => $jobs]);
    }
}
