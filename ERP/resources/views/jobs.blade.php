@extends('layouts.master')
@section('inside-body-tag')

    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h1 class="panel-title">JOBS</h1>
                <p>List of jobs that need to be completed</p>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-10" id="bicycles">
                        <h3>Jobs</h3>
                        <table class="table table-bordered">
                            <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                            <th class="sort pointer-cursor" data-sort="status">Date Created</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                            <th>Operations</th>
                            </thead>
                            <tbody class="list">
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{$job->id}}</td>
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
                        <!-- button for showing backlog tables modal -->
                        <button type="button" class="btn btn-primary ml-1" data-toggle="modal"
                                data-target="#backlog-tables">Backlog
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!--
            modal for showing backlog table
         -->
        <div class="modal fade" id="backlog-tables" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <!-- header of modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Backlog Tables</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <!-- body of modal -->
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="card text-center mt-4">
                                <!-- it holds the tabs -->
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <!-- tab for showing materials -->
                                            <a class="nav-link active" data-toggle="tab" href="#materials">Materials</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="tab-pane fade show active" id="materials">
                                        <!-- real table for showing the materials -->
                                        <!-- <table></table> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
