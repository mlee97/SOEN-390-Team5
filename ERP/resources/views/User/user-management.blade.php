@extends('layouts.master')
@section('inside-body-tag')
    <div class="container mt-5 shadow border rounded">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">User Type</th>
                <th scope="col">Created On</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        @switch($user->user_type)
                            @case(0)
                            IT Department
                            @break

                            @case(1)
                            Human Resources
                            @break

                            @case(2)
                            Floor Worker
                            @break

                            @case(3)
                            Shipping Department
                            @break

                            @default
                            Undefined User Type
                        @endswitch
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td><button type="button" class="btn btn-primary">Edit</button></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection
