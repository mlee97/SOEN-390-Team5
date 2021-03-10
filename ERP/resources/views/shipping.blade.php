@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">SHIPPING</h1>
            <p>List of orders on backlog</p>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-10" id="bicycles">
                    <h3>Shipping</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="jobid">OrderID</th>
                            <th class="sort pointer-cursor" data-sort="status">Material or Part</th>
                            <th class="sort pointer-cursor" data-sort="status">Status</th>
                            <th>Operations</th>
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