@extends('layouts.master')
@section('inside-body-tag')
    <div class="container">
        <h1>Hello, {{Auth::user()-> first_name}}!</h1>
        <h1>Department:
            @switch(Auth::user()->user_type)
                @case(0)
                IT Department
                @break

                @case(3)
                Shipping Department
                @break

                @case(4)
                Inventory
                @break

                @case(5)
                Manufacturer Worker
                @break

                @case(6)
                Accountant
                @break

                @case(7)
                Product Manager
                @break

                @case(8)
                Sales Worker
                @break

                @case(9)
                Quality Worker
                @break

                @default
                Undefined User Type
            @endswitch</h1>
    </div>
@endsection
