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
                    <select name="user_type" class="form-control" required>
                        <option value="">-- SELECT USER TYPE --</option>
                        <option value="0">IT Department</option>
                        <option value="1">Human Resources (HR)</option>
                        <option value="2">Floor Worker</option>
                        <option value="3">Shipping Department</option>
                    </select>
                </div>

                {{csrf_field()}}
                <div class="p-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>


    </form>

@endsection
