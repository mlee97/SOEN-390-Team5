@extends('layouts.master')
@section('inside-body-tag')
    <div class="container-fluid">
        <div class="card text-center mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#all_logs">All Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#get_logs">Access Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#post_logs">Action Logs</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <span data-href="/logging-CSV-export" id="export" class="btn btn-primary btn-sm" onclick="exportToCSV(event.target);">Export into csv</span>
                        <a href="{{ url('/logging-PDF-export') }}" target="_blank" class="btn btn-danger btn-sm">Export into PDF</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane fade show active" id="all_logs">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                </div>

                <div class="tab-pane fade" id="get_logs">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @if($log->request_type == 'GET')
                                <tr {{$log->log_type == 'ERROR' ? "class=log-error":""}} {{$log->log_type == 'WARNING' ? "class=log-warning":""}}>
                                    <td>{{$log->log_type}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{strlen($log->user_id) > 0 ? DB::table('users')->where('id',$log->user_id)->value('email') : "N/A"}}</td>
                                    <td>{{$log->ip_address}}</td>
                                    <td>{{$log->message}}</td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="post_logs">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @if($log->request_type == 'POST')
                                <tr {{$log->log_type == 'ERROR' ? "class=log-error":""}} {{$log->log_type == 'WARNING' ? "class=log-warning":""}}>
                                    <td>{{$log->log_type}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{strlen($log->user_id) > 0 ? DB::table('users')->where('id',$log->user_id)->value('email') : "N/A"}}</td>
                                    <td>{{$log->ip_address}}</td>
                                    <td>{{$log->message}}</td>

                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
