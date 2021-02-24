@extends('layouts.master')
@section('inside-body-tag')
<!-- Container for the whole page -->
<div class="container-fluid">
    <div class="panel panel-primary"> <!-- Panel for the buttons -->
        <div class="panel-heading">
            <h1 class="panel-title">INVENTORY</h1>
            <br/>
        </div>
        <div class="panel-body"> <!-- Begining of the button panel body -->
        <div class="row">
            <div class="col-10" id="bicycles">
            <h3>Bicycles</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Size</th>
                            <th scope="col">Color</th>
                            <th scope="col">Finish</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Quantity In Stock</th>
                            <th scope="col">Stock Status</th>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bikes as $bike)
                        <tr>
                            <td>{{$bike->type}}</td>
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
                            <td><a type="button" class="btn btn-danger" href="deleteBike/{{$bike->id}}">Delete</button></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <!--new bicycle Button-->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bicycle_modal">
                    Add a new Bicyle
                </button>
            </div>
        </div>
            
            <br>
            <div class="row">
            <!-- Parts Table-->
                <div class="col-10" id="parts">
                    <h3>Parts</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">PartID</th>
                                <th scope="col">Part Name</th>
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
                                <td>{{$part->part_quantity_in_stock}}</td>
                                @if($part->part_quantity_in_stock > 10)
                                <td style="background-color:#00FF00">Good</td>
                                @else
                                <td style="background-color:#FF0000">Low</td>
                                @endif
                                <td><a type="button" class="btn btn-danger" href="deletePart/{{$part->id}}">Delete</button></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                    <!-- New Part button-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#part_modal">
                        Add a new Part
                    </button>   
                </div>
            </div>
            <br>
            <div class="row">
            <!-- Materials Table-->
                <div class="col-10" id="materials">
                    <h3>Materials</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">MaterialID</th>
                                <th scope="col">Material Name</th>
                                <th scope="col">Quantity In Stock</th>
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
                                @if($material->material_quantity_in_stock > 10)
                                <td style="background-color:#00FF00">Good</td>
                                @else
                                <td style="background-color:#FF0000">Low</td>
                                @endif
                                <td><a type="button" class="btn btn-danger" href="deleteMaterial/{{$material->id}}">Delete</button></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                    <!-- Materials Button-->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#materials_modal">
                        Add New Materials
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add a new Bicycle popup -->
<div class="modal fade" id="bicycle_modal" tabindex="-1" role="dialog" aria-labelledby="bicycle_modal_lable" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control">
                            <option value="Mountain">Mountain</option>
                            <option value="Racing">Racing</option>
                            <option value="Recreational">Recreational</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size">Frame Size</label>
                        <select id="size" name="size" class="form-control">
                            <option value="18">18"</option>
                            <option value="20">20"</option>
                            <option value="22">22"</option>
                            <option value="24">24"</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <select id="color" name="color" class="form-control">
                            <option value="Red">red</option>
                            <option value="Blue">blue</option>
                            <option value="Green">green</option>
                            <option value="Yellow">yellow</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="finish">Finishes</label>
                        <select id="finish" name="finish" class="form-control">
                            <option value="Matt">Matt</option>
                            <option value="Chrome">Chrome</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select id="grade" name="grade" class="form-control">
                            <option value="Aluminium">Aluminium</option>
                            <option value="Steel">Steel</option>
                            <option value="Carbon">Carbon</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity_in_stock">Quantity in Stock</label>
                        <input id="quantity_in_stock" name="quantity_in_stock" class="form-control" type="text">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="create bike">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Materials popup window-->
<div class="modal fade" id="materials_modal" tabindex="-1" role="dialog" aria-labelledby="materials_modal_label" aria-hidden="true">
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
                        <input name="material_quantity_in_stock" id="material_quantity_in_stock" type="text" class="form-control">
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
<div class="modal fade" id="part_modal" tabindex="-1" role="dialog" aria-labelledby="part_modal_label" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="part_name">Part Name</label>
                        <input name="part_name" id="part_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="part_quantity_in_stock">Quantity</label>
                        <input name="part_quantity_in_stock" id="part_quantity_in_stock" type="text" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="create part">
            </div>
            </form>
        </div>
    </div>
</div>


@endsection
