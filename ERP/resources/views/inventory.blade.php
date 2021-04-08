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
    <!-- Display temporary success message when successfully deleting a part, material or bike-->
    @if(Session::has('success_msg'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success_msg')}}
        </div>
    @endif

    <!-- Container for the whole page -->
    <div class="container-fluid my-4">
        <div class="panel panel-primary"> <!-- Panel for the buttons -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col">
                        <h1 class="panel-title">INVENTORY</h1>
                    </div>
                    <div class="col">
                        <div class="float-right">
                            @include('components.backlog-modal')
                        </div>
                    </div>
                </div>
                <br/>
            </div>
            <div class="panel-body"> <!-- Beginning of the button panel body -->
                <div class="row">
                    <div class="col" id="bicycles">
                        <h3>Bicycles</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Size</th>
                                <th scope="col">Color</th>
                                <th scope="col">Finish</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Quantity In Stock</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bikes as $bike)
                                <tr>
                                    <td>{{$bike->type}}</td>
                                    <td>{{$bike->price}}</td>
                                    <td>{{$bike->size}}</td>
                                    <td>{{$bike->color}}</td>
                                    <td>{{$bike->finish}}</td>
                                    <td>{{$bike->grade}}</td>
                                    <td>{{$bike->quantity_in_stock}}</td>
                                    @if($bike->quantity_in_stock > 10)
                                        <td style="background-color:#00FF00">Good</td>
                                    @else
                                        <td style="background-color:#FF0000">Low</td>
                                    @endif
                                    <td>
                                        <a type="button" class="btn btn-success"
                                            data-target="#modal-show-parts{{ $bike->id }}" data-toggle="modal"
                                            id="modal-show-parts">Show Parts</a>
                                        <a class="btn btn-primary" data-placement="top"
                                           data-target="#modal-edit-bike{{ $bike->id }}" data-toggle="modal"
                                           id="modal-edit-bike">Edit</a>
                                        <a type="button" class="btn btn-danger"
                                           href="deleteBike/{{$bike->id}}">Delete</a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-edit-bike{{ $bike->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit_bike_modal_lable" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit_bike_modal_lable">Bicycle</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                                <form action={{route('edit.bike')}} method="POST">
                                                    @csrf
                                                    <div class="modal-split"> 
                                                        <div class="form-group">
                                                            <label for="id">ID</label>
                                                            <input name="id" id="id" type="text" class="form-control"
                                                                value="{{ old('id')?: $bike->id }}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type">Type</label>
                                                            <select id="type" name="type" class="form-control"
                                                                    value="{{ old('type')?: $bike->type }}" required>
                                                                <option value="Mountain">Mountain</option>
                                                                <option value="Racing">Racing</option>
                                                                <option value="Recreational">Recreational</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="type">Price</label>
                                                            <input id="price" name="price" class="form-control"
                                                                    value="{{ old('price')?: $bike->price }}" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="size">Frame Size</label>
                                                            <select id="size" name="size" class="form-control"
                                                                    value="{{ old('size')?: $bike->size }}" required>
                                                                <option value="18">18"</option>
                                                                <option value="20">20"</option>
                                                                <option value="22">22"</option>
                                                                <option value="24">24"</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="color">Color</label>
                                                            <select id="color" name="color" class="form-control"
                                                                    value="{{ old('color') }}" required>
                                                                <option value="Red">red</option>
                                                                <option value="Blue">blue</option>
                                                                <option value="Green">green</option>
                                                                <option value="Yellow">yellow</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="finish">Finishes</label>
                                                            <select id="finish" name="finish" class="form-control"
                                                                    value="{{ old('finish') }}" required>
                                                                <option value="Matt">Matt</option>
                                                                <option value="Chrome">Chrome</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="grade">Grade</label>
                                                            <select id="grade" name="grade" class="form-control"
                                                                    value="{{ old('grade') }}" required>
                                                                <option value="Aluminium">Aluminium</option>
                                                                <option value="Steel">Steel</option>
                                                                <option value="Carbon">Carbon</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="quantity_in_stock">Quantity in Stock</label>
                                                            <input id="quantity_in_stock" name="quantity_in_stock"
                                                                class="form-control" type="text"
                                                                value="{{ old('quantity_in_stock')?: $bike->quantity_in_stock }}"
                                                                required>
                                                        </div>
                                                    </div>    

                                                    <div class="modal-split">
                                                        <div class="form-group">
                                                            <label for="fork">Fork</label>
                                                            <select id="fork" class="form-control" name="fork" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Fork')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Fork')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Fork")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seatpost">Seatpost</label>
                                                            <select id="seatpost" class="form-control" name="seatpost" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Seatpost')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Seatpost')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Seatpost")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="headset">Headset</label>
                                                            <select id="headset" class="form-control" name="headset" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Headset')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Headset')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Headset")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cranks">Crankset</label>
                                                            <select id="cranks" class="form-control" name="cranks" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Crankset')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Crankset')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Crankset")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pedal">Pedals</label>
                                                            <select id="pedals" class="form-control" name="pedals" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Pedals')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Pedals')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Pedals")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="handlebar">Handlebar</label>
                                                            <select id="handlebar" class="form-control" name="handlebar" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Handlebar')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Handlebar')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Handlebar")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stem">Stem</label>
                                                            <select id="stem" class="form-control" name="stem" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Stem')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Stem')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Stem")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="saddle">Saddle</label>
                                                            <select id="saddle" class="form-control" name="saddle" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Saddle')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Saddle')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Saddle")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="brakes">Brakes</label>
                                                            <select id="brakes" class="form-control" name="brakes" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Brakes')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Brakes')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Brakes")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="shock">Shock</label>
                                                            <select id="shock" class="form-control" name="shock" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Shock')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Shock')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Shock")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="rim">Rim</label>
                                                            <select id="rim" class="form-control" name="rim" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Rim')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Rim')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Rim")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tire">Tire</label>
                                                            <select id="tire" class="form-control" name="tire" required>
                                                                <option value="{{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Tire')
                                                                    ->value('part_id')}}">
                                                                    {{ DB::table('bike_part')
                                                                    ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                                    ->where('bike_id', '=', $bike->id)
                                                                    ->where('category', '=', 'Tire')
                                                                    ->value('part_name')}}</option>
                                                                @foreach($parts as $part)
                                                                    @if($part->category == "Tire")
                                                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-show-parts{{ $bike->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_parts_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_parts_label">Showing Parts</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <label for="fork">Fork</label>
                                                <input name="fork" id="fork" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Fork')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="seatpost">SeatPost</label><br>
                                                <input name="seatpost" id="seatpost" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Seatpost')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="headset">Headset</label>
                                                <input name="headset" id="headset" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Headset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="cranks">Crankset</label>
                                                <input name="cranks" id="cranks" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Crankset')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="pedals">Pedals</label>
                                                <input name="pedals" id="pedals" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Pedals')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="handlebar">Handlebar</label><br>
                                                <input name="handlebar" id="handlebar" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Handlebar')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="stem">Stem</label><br>
                                                <input name="stem" id="stem" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Stem')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label for="saddle">Saddle</label><br>
                                                <input name="saddle" id="saddle" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Saddle')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="brakes">Brakes</label><br>
                                                <input name="brakes" id="brakes" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Brakes')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="shock">Shock</label><br>
                                                <input name="shock" id="shock" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Shock')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>

                                            </div>
                                            <div class="form-group">
                                                <label for="rim">Rim</label><br>
                                                <input name="rim" id="rim" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Rim')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            <div class="form-group">
                                                <label for="tire">Tire</label><br>
                                                <input name="tire" id="tire" type="text" class="form-control" 
                                                    value ="{{ DB::table('bike_part')
                                                        ->join('parts', 'bike_part.part_id', '=', 'parts.id')
                                                        ->where('bike_id', '=', $bike->id)
                                                        ->where('category', '=', 'Tire')
                                                        ->value('part_name')}}"
                                                        readonly>
                                                </input>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                        </div>
                            @if(Auth::user()-> user_type == 7)
                                <!--new bicycle Button-->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bicycle_modal">
                                    Add a new Bicycle
                                </button>
                            @endif
                    </div>
                </div>

                <br>
                <div class="row">
                    <!-- Parts Table-->
                    <div class="col" id="parts">
                        <h3>Parts</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">PartID</th>
                                <th scope="col">Part Name</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity In Stock</th>
                                <th scope="col">Stock Status</th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parts as $part)
                                <tr>
                                    <td>{{$part->id}}</td>
                                    <td>{{$part->part_name}}</td>
                                    <td>{{$part->category}}</td>
                                    <td>{{$part->part_quantity_in_stock}}</td>
                                    @if($part->part_quantity_in_stock > 10)
                                        <td style="background-color:#00FF00">Good</td>
                                    @else
                                        <td style="background-color:#FF0000">Low</td>
                                    @endif
                                    <td>
                                        <a type="button" class="btn btn-success"
                                            data-target="#modal-show-materials{{ $part->id }}" data-toggle="modal"
                                            id="modal-show-materials">Show Materials</a>
                                        <a class="btn btn-primary" data-placement="top"
                                           data-target="#modal-edit-part{{ $part->id }}" data-toggle="modal"
                                           id="modal-edit-part">Edit</a>
                                        <a type="button" class="btn btn-danger"
                                           href="deletePart/{{$part->id}}">Delete</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-edit-part{{ $part->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="edit_part_modal_lable" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit_part_modal_lable">Part</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                                <form action={{route('edit.part')}} method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="id">ID</label>
                                                        <input name="id" id="id" type="text" class="form-control"
                                                               value="{{ old('id')?: $part->id }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="part_name">Part Name</label>
                                                        <input name="part_name" id="part_name" type="text"
                                                               class="form-control"
                                                               value="{{ old('part_name')?: $part->part_name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category">Category</label>
                                                        <select name="category" id="category" type="text" class="form-control" required>
                                                            <option value="{{ DB::table('parts')
                                                                    ->where('id', '=', $part->id)
                                                                    ->value('category')}}">
                                                                    {{ DB::table('parts')
                                                                    ->where('id', '=', $part->id)
                                                                    ->value('category')}}</option>
                                                            @foreach ($categories as $category)
                                                                <option value={{$category->category}}>{{$category->category}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="part_quantity_in_stock">Quantity</label>
                                                        <input name="part_quantity_in_stock" id="part_quantity_in_stock"
                                                               type="text" class="form-control"
                                                               value="{{ old('part_quantity_in_stock')?: $part->part_quantity_in_stock }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-primary" value="Confirm">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="modal-show-materials{{ $part->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="show_materials_modal_label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="show_materials_modal_label">Showing Materials</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                            <div class="form-group">
                                                <ul>
                                                @foreach($partmaterials as $partmaterial)
                                                    @if($partmaterial->part_id == $part->id)
                                                        <li>{{$partmaterial->material_name}}</li>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
</div>
                    @if(Auth::user()-> user_type == 7)
                        <!-- New Part button-->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#part_modal">
                            Add a new Part
                        </button>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Materials Table-->
                    <div class="col" id="materials">
                        <h3>Materials</h3>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">MaterialID</th>
                                <th scope="col">Material Name</th>
                                <th scope="col">Quantity In Stock</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Stock Status</th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($materials as $material)
                                <tr>
                                    <td>{{$material->id}}</td>
                                    <td>{{$material->material_name}}</td>
                                    <td>{{$material->material_quantity_in_stock}}</td>
                                    <td>{{$material->cost}}</td>
                                    @if($material->material_quantity_in_stock > 10)
                                        <td style="background-color:#00FF00">Good</td>
                                    @else
                                        <td style="background-color:#FF0000">Low</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-primary" data-placement="top"
                                           data-target="#modal-edit-material{{ $material->id }}" data-toggle="modal"
                                           id="modal-edit-material">Edit</a>
                                        <a type="button" class="btn btn-danger" href="deleteMaterial/{{$material->id}}">Delete</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modal-edit-material{{ $material->id }}" tabindex="-1"
                                     role="dialog" aria-labelledby="edit_material_modal_lable" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="edit_material_modal_lable">Material</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body"> <!-- Modal body for the input -->
                                                <form action={{route('edit.material')}} method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="id">ID</label>
                                                        <input name="id" id="id" type="text" class="form-control"
                                                               value="{{ old('id')?: $material->id }}" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="material_name">Material Name</label>
                                                        <input name="material_name" id="material_name" type="text"
                                                               class="form-control"
                                                               value="{{ old('material_name')?: $material->material_name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="material_quantity_in_stock">Quantity</label>
                                                        <input name="material_quantity_in_stock"
                                                               id="material_quantity_in_stock" type="text"
                                                               class="form-control"
                                                               value="{{ old('material_quantity_in_stock')?: $material->material_quantity_in_stock }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="type">Cost</label>
                                                        <input id="cost" name="cost" class="form-control" 
                                                            value="{{ old('cost')?: $material->cost }}" required/>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="btn btn-primary"
                                                               value="edit material">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        @if(Auth::user()-> user_type == 7)
                            <!-- Materials Button-->
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#materials_modal">
                                Add New Materials
                            </button>
                        @endif

                        @if(Auth::user()-> user_type == 4)
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#order_materials">
                                Order Materials
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Order Material -->
    <div class="modal fade" id="order_materials" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Place an order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="order_material_id" action={{route('create.order')}} method="POST">
                            @csrf
                            <div>
                                <button type="button" class="btn btn-primary" onClick="add_field()">Add Material(+)</button>
                                <input type="submit" class="btn btn-primary" value="Place Order">
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm">
                                    <label>Material Name</label>
                                </div>
                                <div class="col-sm">
                                    <label>Quantity</label>
                                </div>
                            </div>
                            <div id="input_grp1" class="row">
                                <div class="col-sm">
                                    <div class="form-group">

                                        <select id="MAT1" class="form-control" name="MAT1" required>
                                            <option value="">-- SELECT MATERIAL --</option>
                                            @foreach($materials as $material)
                                                <option value={{$material->id}}>{{$material->material_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <input name="ODR_QTY1" id="ODR_QTY1"
                                               type="number" class="form-control" min=0 required>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add a new Bicycle popup -->
    <div class="modal fade" id="bicycle_modal" tabindex="-1" role="dialog" aria-labelledby="bicycle_modal_lable"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bicycle_modal_lable">Bicycle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> <!-- Modal body for the input -->
                    <form action={{route('create.bike')}} method="POST">
                        @csrf
                        <div class="modal-split">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select id="type" name="type" class="form-control" required>
                                    <option value="Mountain">Mountain</option>
                                    <option value="Racing">Racing</option>
                                    <option value="Recreational">Recreational</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="type">Price</label><br>
                                <input id="price" name="price" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <label for="size">Frame Size</label>
                                <select id="size" name="size" class="form-control" required>
                                    <option value="18">18"</option>
                                    <option value="20">20"</option>
                                    <option value="22">22"</option>
                                    <option value="24">24"</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <select id="color" name="color" class="form-control" required>
                                    <option value="Red">red</option>
                                    <option value="Blue">blue</option>
                                    <option value="Green">green</option>
                                    <option value="Yellow">yellow</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="finish">Finishes</label>
                                <select id="finish" name="finish" class="form-control" required>
                                    <option value="Matt">Matt</option>
                                    <option value="Chrome">Chrome</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select id="grade" name="grade" class="form-control" required>
                                    <option value="Aluminium">Aluminium</option>
                                    <option value="Steel">Steel</option>
                                    <option value="Carbon">Carbon</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity_in_stock">Quantity in Stock</label>
                                <input id="quantity_in_stock" name="quantity_in_stock" class="form-control" type="text"
                                    required>
                            </div>
                        </div>
                        <div class="modal-split">
                            <div class="form-group">
                                <label for="fork">Fork</label>
                                <select id="fork" class="form-control" name="fork" required>
                                    <option value="">-- SELECT FORK --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Fork")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="seatpost">SeatPost</label><br>
                                <select id="seatpost" class="form-control" name="seatpost" required>
                                <option value="">-- SELECT SEATPOST --</option>
                                @foreach($parts as $part)
                                    @if($part->category == "Seatpost")
                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="headset">Headset</label>
                                <select id="headset" class="form-control" name="headset" required>
                                    <option value="">-- SELECT HEADSET --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Headset")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cranks">cranks</label>
                                <select id="cranks" class="form-control" name="cranks" required>
                                    <option value="">-- SELECT CRANKSET --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Crankset")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pedals">Pedals</label>
                                <select id="pedals" class="form-control" name="pedals" required>
                                    <option value="">-- SELECT PEDALS --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Pedals")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="handlebar">Handlebar</label><br>
                                <select id="handlebar" class="form-control" name="handlebar" required>
                                    <option value="">-- SELECT HANDLEBAR --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Handlebar")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            
                            </div>
                            <div class="form-group">
                                <label for="stem">Stem</label><br>
                                <select id="stem" class="form-control" name="stem" required>
                                    <option value="">-- SELECT STEM --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Stem")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                
                                <label for="saddle">Saddle</label><br>
                                <select id="saddle" class="form-control" name="saddle" required>
                                    <option value="">-- SELECT SADDLE --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Saddle")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="brakes">Brakes</label><br>
                                <select id="brakes" class="form-control" name="brakes" required>
                                    <option value="">-- SELECT BRAKES --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Brakes")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="shock">Shock</label><br>
                                <select id="shock" class="form-control" name="shock" required>
                                    <option>-- SELECT SHOCK --</option>
                                    @foreach($parts as $part)
                                        @if($part->category == "Shock")
                                            <option value={{$part->id}}>{{$part->part_name}}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="rim">Rim</label><br>
                                <select id="rim" class="form-control" name="rim" required>
                                <option value="">-- SELECT RIM --</option>
                                @foreach($parts as $part)
                                    @if($part->category == "Rim")
                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tire">Tire</label><br>
                                <select id="tire" class="form-control" name="tire" required>
                                <option value="">-- SELECT TIRE --</option>
                                @foreach($parts as $part)
                                    @if($part->category == "Tire")
                                        <option value={{$part->id}}>{{$part->part_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                               
                        </div>
                        
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Materials popup window-->
    <div class="modal fade" id="materials_modal" tabindex="-1" role="dialog" aria-labelledby="materials_modal_label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materials_modal_label"> Materials</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action={{route('create.material')}} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="material_name">Material Name</label>
                            <input name="material_name" id="material_name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="material_quantity_in_stock">Quantity</label>
                            <input name="material_quantity_in_stock" id="material_quantity_in_stock" type="text"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="type">Cost</label>
                            <input id="cost" name="cost" class="form-control" required/>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="create material">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Add New Part POP up window Modal-->
    <div class="modal fade" id="part_modal" tabindex="-1" role="dialog" aria-labelledby="part_modal_label"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="part_modal_label">Part</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> <!-- Modal body for the input or form -->
                    <form action={{route('create.part')}} method="POST">
                        @csrf
                        <div class="modal-split">
                            <div class="form-group">
                                <label for="part_name">Part Name</label>
                                <input name="part_name" id="part_name" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" type="text" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value={{$category->category}}>{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="part_quantity_in_stock">Quantity</label>
                                <input name="part_quantity_in_stock" id="part_quantity_in_stock" type="text"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-split" id="add-materials-to-part">
                            <div>
                                <button type="button" class="btn btn-primary" onClick="add_field_materials_part()">Add Material(+)</button>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm">
                                    <label>Material Name</label>
                                </div>
                            </div>
                            <div id="input_mat_grp1" class="row">
                                <div class="col-sm">
                                    <div class="form-group">

                                        <select id="MAT_PART1" class="form-control" name="MAT_PART1" required>
                                            <option value="">-- SELECT MATERIAL --</option>
                                            @foreach($materials as $material)
                                                <option value={{$material->id}}>{{$material->material_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </form>
                </div>
            </div>
        </div>

       <!-- script to add more rows in the 'place order' modal-->
        <script type="text/javascript">
            var input_row_count = 1;

            function add_field() {
                input_row_count++;
                var form = document.getElementById('order_material_id');
                var input_row = document.getElementById('input_grp1');

                var input_row_grp_str = 'input_grp' + input_row_count
                var mat_input_str = 'MAT' + input_row_count
                var qty_input_str = 'ODR_QTY' + input_row_count


                var cloned_input = input_row.cloneNode(true);
                cloned_input.setAttribute('id', input_row_grp_str)

                cloned_input.querySelector('[name ="MAT1"]').setAttribute('id', mat_input_str)
                cloned_input.querySelector('[name ="MAT1"]').setAttribute('name', mat_input_str)

                cloned_input.querySelector('[name ="ODR_QTY1"]').setAttribute('id', qty_input_str)
                cloned_input.querySelector('[name ="ODR_QTY1"]').setAttribute('name', qty_input_str)

                form.append(cloned_input)


            }
            
            //Add functionality to the Add Materials button
            function add_field_materials_part() {
                input_row_count++;
                var form = document.getElementById('add-materials-to-part');
                var input_row = document.getElementById('input_mat_grp1');

                //Set variables to new field id and name
                var input_row_grp_str = 'input_mat_grp' + input_row_count
                var mat_input_str = 'MAT_PART' + input_row_count


                var cloned_input = input_row.cloneNode(true);
                cloned_input.setAttribute('id', input_row_grp_str)

                //Clone the original element but change the name and id to the new element
                cloned_input.querySelector('[name ="MAT_PART1"]').setAttribute('id', mat_input_str)
                cloned_input.querySelector('[name ="MAT_PART1"]').setAttribute('name', mat_input_str)

                form.append(cloned_input)


            }

            $(document).ready(function() {
                prep_modal();
            });

            function prep_modal()
            {
            $(".modal").each(function() {

            var element = this;
                var pages = $(this).find('.modal-split');

            if (pages.length != 0)
            {
                    pages.hide();
                    pages.eq(0).show();

                    var b_button = document.createElement("button");
                            b_button.setAttribute("type","button");
                                b_button.setAttribute("class","btn btn-primary");
                                b_button.setAttribute("style","display: none;");
                                b_button.innerHTML = "Back";

                    var n_button = document.createElement("button");
                            n_button.setAttribute("type","button");
                                n_button.setAttribute("class","btn btn-primary");
                                n_button.innerHTML = "Next";

                    $(this).find('.modal-footer').append(b_button).append(n_button);


                    var page_track = 0;

                    $(n_button).click(function() {
                    
                    this.blur();

                        if(page_track == 0)
                        {
                            $(b_button).show();
                        }

                        if(page_track == pages.length-2)
                        {
                            $(n_button).text("Create");  
                        }

                    if(page_track == pages.length-1)
                    {
                    $(element).find("form").submit();
                    }

                        if(page_track < pages.length-1)
                        {
                            page_track++;

                            pages.hide();
                            pages.eq(page_track).show();
                        }


                    });

                    $(b_button).click(function() {

                        if(page_track == 1)
                        {
                            $(b_button).hide();
                        }

                        if(page_track == pages.length-1)
                        {
                            $(n_button).text("Next");
                        }

                        if(page_track > 0)
                        {
                            page_track--;

                            pages.hide();
                            pages.eq(page_track).show();
                        }


                    });

            }

            });
            }

        </script>

@endsection
