@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <br/>
            <h1 class="panel-title">ASSEMBLY</h1>
            <br/>
        </div>
        <div class="panel-body">

            <div class="row">

            <!-- Bicycles Tables-->
                <div class="col" id="bicycles">
                    <h3>Bicycle Requirements</h3>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">BikeId</th>
                            <th scope="col">Fork</th>
                            <th scope="col">Seatpost</th>
                            <th scope="col">Headset</th>
                            <th scope="col">Crankset</th>
                            <th scope="col">Pedals</th>
                            <th scope="col">Handlebar</th>
                            <th scope="col">Stem</th>
                            <th scope="col">Saddle</th>
                            <th scope="col">Brakes</th>
                            <th scope="col">Shock</th>
                            <th scope="col">Rim</th>
                            <th scope="col">Tire</th>
                        </thead>
                        <tbody class="list">
                            @foreach($bikes as $bike)
                                <tr>
                                    <td>{{$bike->id}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}</td>
                                    <td>{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}</td>                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">

            <!-- Parts Table-->
                <div class="col" id="parts">
                    <h3>Parts Requirements</h3>
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th scope="col">PartID</th>
                            <th scope="col">Part Name</th>
                            <th scope="col">Materials</th>
                        </thead>
                        <tbody class="list">
                            @foreach($parts as $part)
                                <tr>
                                    <td>{{$part->id}}</td>
                                    <td>{{$part->part_name}}</td>
                                    <td>
                                        <ul>
                                        @foreach($materials as $material)
                                            @if($material->part_id == $part->id)
                                               <li>{{$material->material_name}}</li>
                                            @endif
                                        @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

@endsection