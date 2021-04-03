@extends('layouts.master')
@section('inside-body-tag')

    <!-- Display temporary error message when redirected to this page by controller due to an error-->
    @if(count($errors->all()))
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action={{route('create.user')}} method="POST">
        <div class="d-flex justify-content-center mt-5">
            <div class="d-flex flex-column border rounded shadow p-2">
                <div class="d-flex flex-row p-2">
                    <div class="py-2">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="p-2">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}" required>
                    </div>

                </div>
                <div class="p-2">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="p-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name=password class="form-control" id="password" required>

                </div>
                <div class="p-2">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           required>
                </div>

                <div class="p-2">
                    <!-- If you want to modify the user type dropdown, see the user-type-dropdown blade file -->
                    @include('components.user-type-dropdown')
                </div>

                {{csrf_field()}}
                <div class="p-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>


    </form>

@endsection
