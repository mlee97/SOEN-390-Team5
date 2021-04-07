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
    <form action={{route('create.job')}} method="POST">
        <div class="d-flex justify-content-center mt-5">
            <div class="d-flex flex-column border rounded shadow p-2">
                <div class="p-2">
                    <label for="user" class="form-label">Assign Job To</label>
                    <select id="user" name="user" class="form-control py-1">
                        <option value=""> -- SELECT ASSIGNEE --</option>
                        @foreach($users as $user)
                            <option value={{$user->id}}> {{$user->first_name. " ". $user->last_name}} </option>
                        @endforeach
                    </select>
                    <hr>
                    <div class="d-flex flex-row py-2">
                        <div class="pr-2">
                            <label for="bike" class="form-label">Bike to Produce</label>
                            <select id="bike" name="bike" class="form-control py-1" required>
                                <option value=""> -- SELECT BIKE --</option>
                                @foreach($bikes as $bike)
                                    <option value={{$bike->id}}> {{$bike->type}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pl-2">
                            <label for="order_qty" class="form-label">Quantity to Produce</label>
                            <input type="number" name="order_qty" class="form-control" id="order_qty" required>
                        </div>

                    </div>
                    <div class="py-2">
                        <label for="status" class="form-label">Job Status</label>
                        <select id="status" name="status" class="form-control  py-1" required>
                            <option value="Queued" selected>Queued</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="py-2">
                        <label for="quality" class="form-label">Job Quality</label>
                        <select id="quality" name="quality" class="form-control py-1" required>
                        <option value="Not Inspected">Not Inspected</option>
                        <option value="Under Inspection">Under Inspection</option>
                        <option value="Passed Inspection">Passed Inspection</option>
                        <option value="Failed Inspection">Failed Inspection</option>
                        </select>
                    </div>
                </div>

                {{csrf_field()}}
                <div class="p-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>


    </form>

@endsection
