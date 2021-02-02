@extends('layouts.master')
@section('inside-body-tag')

    @if(count($errors->all()))
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('success_msg'))
        <div class="alert alert-success" role="alert">
           {{ Session::get('success_msg')}}
        </div>
    @endif

        <form action="{{route('create.user')}}">
            <div class="d-grid gap-2 col-3 mx-auto mt-5">
            <button class="btn btn-primary" type="submit">Create User</button>
            </div>
        </form>


    <div class="container mt-3 shadow border rounded">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">User Type</th>
                <th scope="col">Created On</th>
                <th scope="col">Last Updated</th>
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
                    <td>{{$user->updated_at}}</td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">Edit</button></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
        @foreach($users as $user)
    <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDIT USER:  {{$user->first_name}} {{$user->last_name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action={{route('update.user')}} method="POST">

                            <div class="d-flex flex-column p-2">
                                <div class="d-flex flex-row p-2">
                                    <div class="py-2">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{$user->first_name}}" required>
                                    </div>
                                    <div class="p-2">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{$user->last_name}}" required>
                                    </div>

                                </div>
                                <div class="p-2">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}" required>
                                </div>

                                <div class="p-2">
                                    <label for="user_type" class="form-label">User type</label>
                                    <select id="user_type" name="user_type" class="form-select" required>
                                        <option value="">-- SELECT USER TYPE --</option>
                                        <option value="0" @if($user->user_type ==0) selected @endif>IT Department</option>
                                        <option value="1" @if($user->user_type ==1) selected @endif>Human Resources (HR)</option>
                                        <option value="2" @if($user->user_type ==2) selected @endif>Floor Worker</option>
                                        <option value="3" @if($user->user_type ==3) selected @endif>Shipping Department</option>
                                    </select>
                                </div>

                                <!--CSFR token for security -->
                                {{csrf_field()}}

                                 <!--Hidden field to pass user ID to server-side -->
                                <input name="user_id" type="hidden" value="{{$user->id}}">
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
        @endforeach
@endsection
