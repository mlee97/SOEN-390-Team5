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

    public function createJob(Request $request){


        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

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

        $newJob= Job::create([
            'status' => $request->status,
        ]);

        $msg_str = 'Job with ID '. $newJob->id. ' successfully created';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);


        return redirect('/jobs')
        ->with('success_msg', 'Job has been successfully created!');
    }

    public function deleteJob($id, Request $request){

        $job = Job::find($id);
        $job->delete();

        $msg_str = 'Job with ID '. $id . ' successfully deleted';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('jobs')
            ->with('success_msg', 'Job has been successfully deleted'); //Send a temporary success message. This is saved in the session
    }


    public function updateJobStatus($job_id, Request $request){


        $status = Job::find($job_id);

        if($status->status == "Queued") {
            $status->status = "Complete";
        }
        else {
            $status->status = "Queued";
        }

        $status->save();

        $msg_str = 'Job status with ID '. $status->id. ' updated successfully';
        Log::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $request ->ip(),
            'log_type' => 'INFO',
            'request_type' => 'POST',
            'message' => $msg_str,
        ]);

        return redirect()->route('jobs')
            ->with('success_msg', 'Changes have been successfully saved'); //Send a temporary success message. This is saved in the session
    }

    public function goToCreateJob(Request $request) {

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

    public function goToJobManagement(Request $request){

        $jobs = Job::all();
        $orders = Order::all();

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
