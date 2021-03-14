@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">Machine Status</h1>
        </div>
        <div class="panel-body">
            <div class="row">
            <!-- Machines Table-->
                <div class="col-10" id="machines">

                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="type">Machine</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                        </thead>
                        <tbody class="list">
            
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
            </div>
            <br>
        </div>
    </div>
</div>

@endsection