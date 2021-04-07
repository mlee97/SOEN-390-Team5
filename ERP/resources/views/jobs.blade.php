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
                            @foreach ($jobs->sortByDesc('status') as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name'). " ". DB::table('users')->where('id',$job->user_id)->value('last_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td><a type="button" data-toggle="modal" data-target="#jobStatusModal{{$job->id}}" class="btn btn-primary">Edit Job
                                        </a> <a type="button" class="btn btn-danger"
                                                          href="delete-job/{{$job->id}}">Delete</a></td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="jobStatusModal{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Change Status for Job # {{$job->id}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action={{route('change.job.status')}} method="POST">
                                            <div class="modal-body">
                                                <label for="status" class="form-label">Job ID</label>
                                                <input class="form-control" name="jobID" type="text" value="{{$job->id}}" readonly>
<br>
                                                <label for="user" class="form-label">Edit Assignee</label>
                                                <select id="user" name="user" class="form-control py-1">
                                                    <option value=""> -- SELECT ASSIGNEE --</option>
                                                    @foreach($users as $user)
                                                        <option value={{$user->id}}@if($job->user_id == $user->id) selected @endif> {{$user->first_name. " ". $user->last_name}} </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                                <label for="status" class="form-label">Job Status</label>
                                                <select id="status" name="status" class="form-control py-1" required>
                                                    <option value="Queued" @if($job->status == "Queued") selected @endif>Queued</option>
                                                    <option value="In Progress" @if($job->status == "In Progress") selected @endif>In Progress</option>
                                                    <option value="Issue" @if($job->status == "Issue") selected @endif>Issue</option>
                                                    <option value="Completed" @if($job->status == "Completed") selected @endif>Completed</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                                {{csrf_field()}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
