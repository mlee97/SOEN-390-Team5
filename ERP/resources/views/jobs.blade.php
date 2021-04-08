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

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col" id="jobs">
                        <!-- Jobs In Progress -->
                        <h3>Jobs In Progress</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Assignee</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Bicycle Type</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Quantity</th>
                                <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                                <th class="sort pointer-cursor" data-sort="status">Status</th>
                                <th class="sort pointer-cursor" data-sort="status">Quality</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($jobsInProgress as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name'). " ". DB::table('users')->where('id',$job->user_id)->value('last_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td>{{$job->quality}}</td>
                                    <td><a type="button" data-toggle="modal" data-target="#jobStatusModal{{$job->id}}" class="btn btn-primary">Edit Job</a>
                                        <a type="button" class="btn btn-danger" href="delete-job/{{$job->id}}">Delete</a>
                                        <a type="button" class="btn btn-success" data-target="#modal-show-parts{{ $job->id }}" data-toggle="modal" id="modal-show-parts">Show Parts</a></td>
                                    </tr>

                                    <div class="modal fade" id="modal-show-parts{{ $job->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_parts_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_parts_label">Showing Parts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <label for="fork">Fork</label>
                                                <input name="fork" id="fork" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="seatpost">SeatPost</label><br>
                                                <input name="seatpost" id="seatpost" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="headset">Headset</label>
                                                <input name="headset" id="headset" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="cranks">Crankset</label>
                                                <input name="cranks" id="cranks" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="pedals">Pedals</label>
                                                <input name="pedals" id="pedals" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="handlebar">Handlebar</label><br>
                                                <input name="handlebar" id="handlebar" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="stem">Stem</label><br>
                                                <input name="stem" id="stem" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="saddle">Saddle</label><br>
                                                <input name="saddle" id="saddle" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="brakes">Brakes</label><br>
                                                <input name="brakes" id="brakes" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="shock">Shock</label><br>
                                                <input name="shock" id="shock" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="rim">Rim</label><br>
                                                <input name="rim" id="rim" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="tire">Tire</label><br>
                                                <input name="tire" id="tire" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action={{route('change.job.info')}} method="POST">
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
                                                <br>
                                                <label for="quality" class="form-label">Job Quality</label>
                                                <select id="quality" name="quality" class="form-control py-1" required>
                                                    <option value="Not Inspected" @if($job->quality == "Not Inspected") selected @endif>Not Inspected</option>
                                                    <option value="Under Inspection" @if($job->quality == "Under Inspection") selected @endif>Under Inspection</option>
                                                    <option value="Passed Inspection" @if($job->quality == "Passed Inspection") selected @endif>Passed Inspection</option>
                                                    <option value="Failed Inspection" @if($job->quality == "Failed Inspection") selected @endif>Failed Inspection</option>
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
                        </div>
                        <!-- Jobs Queued -->
                        <h3>Jobs Queued</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Assignee</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Bicycle Type</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Quantity</th>
                                <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                                <th class="sort pointer-cursor" data-sort="status">Status</th>
                                <th class="sort pointer-cursor" data-sort="status">Quality</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($jobsQueued as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name'). " ". DB::table('users')->where('id',$job->user_id)->value('last_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td>{{$job->quality}}</td>
                                    <td><a type="button" data-toggle="modal" data-target="#jobStatusModal{{$job->id}}" class="btn btn-primary">Edit Job</a> 
                                        <a type="button" class="btn btn-danger" href="delete-job/{{$job->id}}">Delete</a>
                                        <a type="button" class="btn btn-success" data-target="#modal-show-parts{{ $job->id }}" data-toggle="modal" id="modal-show-parts">Show Parts</a></td>
                                </tr>

                                <div class="modal fade" id="modal-show-parts{{ $job->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_parts_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_parts_label">Showing Parts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <label for="fork">Fork</label>
                                                <input name="fork" id="fork" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="seatpost">SeatPost</label><br>
                                                <input name="seatpost" id="seatpost" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="headset">Headset</label>
                                                <input name="headset" id="headset" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="cranks">Crankset</label>
                                                <input name="cranks" id="cranks" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="pedals">Pedals</label>
                                                <input name="pedals" id="pedals" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="handlebar">Handlebar</label><br>
                                                <input name="handlebar" id="handlebar" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="stem">Stem</label><br>
                                                <input name="stem" id="stem" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="saddle">Saddle</label><br>
                                                <input name="saddle" id="saddle" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="brakes">Brakes</label><br>
                                                <input name="brakes" id="brakes" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="shock">Shock</label><br>
                                                <input name="shock" id="shock" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="rim">Rim</label><br>
                                                <input name="rim" id="rim" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="tire">Tire</label><br>
                                                <input name="tire" id="tire" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action={{route('change.job.info')}} method="POST">
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
                                                <br>
                                                <label for="quality" class="form-label">Job Quality</label>
                                                <select id="quality" name="quality" class="form-control py-1" required>
                                                    <option value="Not Inspected" @if($job->quality == "Not Inspected") selected @endif>Not Inspected</option>
                                                    <option value="Under Inspection" @if($job->quality == "Under Inspection") selected @endif>Under Inspection</option>
                                                    <option value="Passed Inspection" @if($job->quality == "Passed Inspection") selected @endif>Passed Inspection</option>
                                                    <option value="Failed Inspection" @if($job->quality == "Failed Inspection") selected @endif>Failed Inspection</option>
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
                        </div>
                        <!-- Jobs Completed -->
                        <h3>Jobs Completed</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Assignee</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Bicycle Type</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Quantity</th>
                                <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                                <th class="sort pointer-cursor" data-sort="status">Status</th>
                                <th class="sort pointer-cursor" data-sort="status">Quality</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($jobsCompleted as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name'). " ". DB::table('users')->where('id',$job->user_id)->value('last_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td>{{$job->quality}}</td>
                                    <td><a type="button" data-toggle="modal" data-target="#jobStatusModal{{$job->id}}" class="btn btn-primary">Edit Job</a> 
                                        <a type="button" class="btn btn-danger" href="delete-job/{{$job->id}}">Delete</a>
                                        <a type="button" class="btn btn-success" data-target="#modal-show-parts{{ $job->id }}" data-toggle="modal" id="modal-show-parts">Show Parts</a></td>
                                </tr>

                                <div class="modal fade" id="modal-show-parts{{ $job->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_parts_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_parts_label">Showing Parts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <label for="fork">Fork</label>
                                                <input name="fork" id="fork" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="seatpost">SeatPost</label><br>
                                                <input name="seatpost" id="seatpost" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="headset">Headset</label>
                                                <input name="headset" id="headset" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="cranks">Crankset</label>
                                                <input name="cranks" id="cranks" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="pedals">Pedals</label>
                                                <input name="pedals" id="pedals" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="handlebar">Handlebar</label><br>
                                                <input name="handlebar" id="handlebar" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="stem">Stem</label><br>
                                                <input name="stem" id="stem" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="saddle">Saddle</label><br>
                                                <input name="saddle" id="saddle" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="brakes">Brakes</label><br>
                                                <input name="brakes" id="brakes" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="shock">Shock</label><br>
                                                <input name="shock" id="shock" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="rim">Rim</label><br>
                                                <input name="rim" id="rim" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="tire">Tire</label><br>
                                                <input name="tire" id="tire" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action={{route('change.job.info')}} method="POST">
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
                                                <br>
                                                <label for="quality" class="form-label">Job Quality</label>
                                                <select id="quality" name="quality" class="form-control py-1" required>
                                                    <option value="Not Inspected" @if($job->quality == "Not Inspected") selected @endif>Not Inspected</option>
                                                    <option value="Under Inspection" @if($job->quality == "Under Inspection") selected @endif>Under Inspection</option>
                                                    <option value="Passed Inspection" @if($job->quality == "Passed Inspection") selected @endif>Passed Inspection</option>
                                                    <option value="Failed Inspection" @if($job->quality == "Failed Inspection") selected @endif>Failed Inspection</option>
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
                        </div>
                        <!-- Jobs Issues -->
                        <h3>Job Issues</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Assignee</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Bicycle Type</th>
                                <th class="sort pointer-cursor" data-sort="jobid">Quantity</th>
                                <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                                <th class="sort pointer-cursor" data-sort="status">Status</th>
                                <th class="sort pointer-cursor" data-sort="status">Quality</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($jobsIssue as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
                                    <td>{!!($job->user_id)==null ? html_entity_decode("<p class=text-muted><em>NONE</em></p>"): DB::table('users')->where('id',$job->user_id)->value('first_name'). " ". DB::table('users')->where('id',$job->user_id)->value('last_name') !!}</td>
                                    <td>{{DB::table('bikes')->where('id',$job->bike_id)->value('type')}}</td>
                                    <td>{{$job->quantity}}</td>
                                    <td>{{$job->created_at}}</td>
                                    <td>{{$job->status}}</td>
                                    <td>{{$job->quality}}</td>
                                    <td><a type="button" data-toggle="modal" data-target="#jobStatusModal{{$job->id}}" class="btn btn-primary">Edit Job</a> 
                                        <a type="button" class="btn btn-danger" href="delete-job/{{$job->id}}">Delete</a>
                                        <a type="button" class="btn btn-success" data-target="#modal-show-parts{{ $job->id }}" data-toggle="modal" id="modal-show-parts">Show Parts</a></td>
                                </tr>

                                <div class="modal fade" id="modal-show-parts{{ $job->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_parts_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_parts_label">Showing Parts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <label for="fork">Fork</label>
                                                <input name="fork" id="fork" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="seatpost">SeatPost</label><br>
                                                <input name="seatpost" id="seatpost" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="headset">Headset</label>
                                                <input name="headset" id="headset" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="cranks">Crankset</label>
                                                <input name="cranks" id="cranks" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="pedals">Pedals</label>
                                                <input name="pedals" id="pedals" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="handlebar">Handlebar</label><br>
                                                <input name="handlebar" id="handlebar" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="stem">Stem</label><br>
                                                <input name="stem" id="stem" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="saddle">Saddle</label><br>
                                                <input name="saddle" id="saddle" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="brakes">Brakes</label><br>
                                                <input name="brakes" id="brakes" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="shock">Shock</label><br>
                                                <input name="shock" id="shock" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="rim">Rim</label><br>
                                                <input name="rim" id="rim" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="tire">Tire</label><br>
                                                <input name="tire" id="tire" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $job->bike_id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action={{route('change.job.info')}} method="POST">
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
                                                <br>
                                                <label for="quality" class="form-label">Job Quality</label>
                                                <select id="quality" name="quality" class="form-control py-1" required>
                                                    <option value="Not Inspected" @if($job->quality == "Not Inspected") selected @endif>Not Inspected</option>
                                                    <option value="Under Inspection" @if($job->quality == "Under Inspection") selected @endif>Under Inspection</option>
                                                    <option value="Passed Inspection" @if($job->quality == "Passed Inspection") selected @endif>Passed Inspection</option>
                                                    <option value="Failed Inspection" @if($job->quality == "Failed Inspection") selected @endif>Failed Inspection</option>
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
                        </div>
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
