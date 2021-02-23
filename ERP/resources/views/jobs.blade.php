@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">JOBS</h1>
            <!--TO BE REMOVED-->
            <p>TO BE REMOVED -- Jobs that need to be completed</p>
        </div>
        <div class="panel-body">

            <div class="row">

            <!-- Bicycles Tables-->
                <div class="col-10" id="bicycles">
                    <h3>Jobs</h3>

                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">JobID</th>
                            <th class="sort pointer-cursor" data-sort="color">status</th>
                            <th>Date created</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection