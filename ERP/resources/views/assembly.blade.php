@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">ASSEMBLY</h1>
            <!--TO BE REMOVED-->
            <p>TO BE REMOVED -- this page is to know what bicycle needs what part + what parts need what materials</p>
            <p>table content is irrelevant, but they are there to show what itd look when all is said and done</p>
        </div>
        <div class="panel-body">

            <div class="row">

            <!-- Bicycles Tables-->
                <div class="col-10" id="bicycles">
                    <h3>Bicycle Requirements</h3>

                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="type">PartID</th>
                            <th class="sort pointer-cursor" data-sort="color">Part Name</th>
                            <th class="sort pointer-cursor" data-sort="quantity">Required Materials</th>
                            <th>Quantity Needed</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">

            <!-- Parts Table-->
                <div class="col-10" id="parts">
                    <h3>Parts Requirements</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="type">MaterialID</th>
                            <th class="sort pointer-cursor" data-sort="color">Material Name</th>
                            <th>Quantity Required</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table> 
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

@endsection