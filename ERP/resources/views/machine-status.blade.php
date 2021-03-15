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
                            <th class="sort pointer-cursor" data-sort="status">Toggle Status</th>
                        </thead>
                        <tbody class="list">
                        @foreach($machines as $machine)
                            <tr>
                                <td>{{$machine->name}}</td>
                                @if($machine->status == "online")
                                <td style="background-color:#00FF00">Online</td>
                                @else
                                <td style="background-color:#FF0000">Offline</td>
                                @endif
                                @if ($machine->status == "offline")
                                    <td><a type="button" class="btn btn-primary ml-1" href="change-status/{{$machine->id}}">Turn On</button></td>
                                @else
                                    <td><a type="button" class="btn btn-danger" href="change-status/{{$machine->id}}">Turn Off</button></td>
                                @endif
                            </tr>
                        @endforeach
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