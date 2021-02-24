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
                                <td><a type="button" class="btn btn-primary" href="toggle-job-status/{{$job->id}}">Toggle Status</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form action="{{route('create.job')}}">
                    <button type="submit" class="btn btn-primary">Add new job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection