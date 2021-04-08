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


    <!-- script that will display the proper user type definition based on the
user-type-dropdown component. Therefore, the component is used as the single source of truth
for the list of user types-->
    <script type="text/javascript">
        function displayProperUserType(u_type) {

            var dropDown = document.getElementById('user_type');
            for (var i=0; i<dropDown.length; i++){

                if(dropDown.options[i].value !== "" && dropDown.options[i].value == u_type) {
                    return dropDown.options[i].text
                }
            }
        }
    </script>

    <!-- Modal -->
    <!-- The location of the modal does not matter for it to function.
     However, in this specific page, it is placed BEFORE the trigger because of the
     javascript function displayProperUserType. The function needs to capture the dropdown form element
     BEFORE the user management table is loaded (since the function is called in within the table elements).
      If the modal was placed after the function call, then the dropDown variable would be null (since the element
      does not exist on the page yet)-->
    @foreach($users as $user)
        <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT USER:  {{$user->first_name}} {{$user->last_name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                    <!-- If you want to modify the user type dropdown, see the user-type-dropdown blade file -->
                                    @include('components.user-type-dropdown')
                                </div>

                                <!--CSFR token for security -->
                            {{csrf_field()}}

                            <!--Hidden field to pass user ID to server-side -->
                                <input name="user_id" type="hidden" value="{{$user->id}}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

        <form action="{{route('create.user')}}">
            <div class="col-sm-3 mx-auto mt-5">
            <button class="btn btn-primary btn-block" type="submit">Create User</button>
            </div>
        </form>


    <div class="container mt-3 shadow border rounded">
    <div class="table-responsive">
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
                        <script>document.write(displayProperUserType({{$user->user_type}}))</script>
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUser{{$user->id}}">Edit</button></td>
                </tr>

            @endforeach
            </tbody>
        </table>
        </div>
    </div>




@endsection
