@extends('layouts.master')
@section('inside-body-tag')

    <div class="container-fluid my-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col">
                        <h1 class="panel-title">JOBS</h1>
                    </div>
                    <div class="col">
                        <div class="float-right">
                            @include('components.backlog-modal')
                        </div>
                    </div>
                </div>

                <p>List of jobs that need to be completed</p>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-10" id="jobs">
                        <!-- Jobs table -->
                        <h3>Jobs</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Assignee</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Bicycle Type</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Quantity</th>
                                <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                                <th class="sort pointer-cursor" data-sort="status">Status</th>
                                <th>Operations</th>
                            </tr>
                            </thead>

                            <tbody class="list">
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td><a type="button" class="btn btn-primary" href="toggle-job-status/{{$job->id}}">Toggle
                                            Status</a> <a type="button" class="btn btn-danger"
                                                          href="delete-job/{{$job->id}}">Delete</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- we dont need to use form, because we are not
                         sending any data to the server, we just wanna go to another
                         page that it's easily possible using <a> tag.
                          -->
                        <a href="{{route('create.job')}}" class="btn btn-primary">Add new job</a>

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
