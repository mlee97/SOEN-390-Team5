@extends('layouts.master')
@section('inside-body-tag')
    <div class="container-fluid">
    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Timestamp</th>
            <th scope="col">User</th>
            <th scope="col">IP Address</th>
            <th scope="col">Message</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
        <tr {{$log->log_type == 'ERROR' ? "class=log-error":""}} {{$log->log_type == 'WARNING' ? "class=log-warning":""}}>
            <td>{{$log->log_type}}</td>
            <td>{{$log->created_at}}</td>
            <td>{{strlen($log->user_id) > 0 ? DB::table('users')->where('id',$log->user_id)->value('email') : "N/A"}}</td>
            <td>{{$log->ip_address}}</td>
            <td>{{$log->message}}</td>

        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
