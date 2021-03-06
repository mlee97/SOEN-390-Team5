@extends('layouts.master')
@section('inside-body-tag')
<div class="container-fluid">
    <div class="card text-center mt-4">
        <!-- it holds the tabs -->
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <!-- tab for showing materials -->
                    <a class="nav-link active" data-toggle="tab" href="#materials">Materials</a>
                </li>
                <li class="nav-item">
                    <!-- tab for showing parts -->
                    <a class="nav-link" data-toggle="tab" href="#parts">Parts</a>
                </li>
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="tab-pane fade show active" id="materials">
                <!-- real table for showing the materials -->
                <!-- <table></table> -->
            </div>
            <div class="tab-pane fade" id="parts">
                <!-- real table for showing the parts -->
                <!-- <table></table> -->
            </div>
        </div>
    </div>
</div>
@endsection