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
                    <select name="status" class="form-select" required>
                        <option value="">select job status</option>
                        <option value="Queued">Queued</option>
                        <option value="Completed">Completed</option>
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