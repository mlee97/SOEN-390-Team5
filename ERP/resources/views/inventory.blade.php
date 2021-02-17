@extends('layouts.master')
@section('inside-body-tag')

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title">INVENTORY</h1>
            <p>TO BE REMOVED -- this page is to know what is currently in stock of the company</p>
        </div>
        <div class="panel-body">

            <div class="row">

            <!-- Bicycles Tables-->
                <div class="col-10" id="bicycles">
                    <h3>Bicycles</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="type">Type</th>
                            <th class="sort pointer-cursor" data-sort="size">Size</th>
                            <th class="sort pointer-cursor" data-sort="color">Color</th>
                            <th class="sort pointer-cursor" data-sort="finishes">Finishes</th>
                            <th class="sort pointer-cursor" data-sort="grade">Grade</th>
                            <th class="sort pointer-cursor" data-sort="quantity">Quantity In Stock</th>
                            <th>Operations</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table>

                    <!--new bicycle Button-->
                    <div class="row">
                        <div class="col-5">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bicycle_modal">
                                Add a new Bicyle
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
            <!-- Parts Table-->
                <div class="col-10" id="parts">
                    <h3>Parts</h3>
                    <table class="table table-bordered">
                        <thead>
                            <th class="sort pointer-cursor" data-sort="type">PartID</th>
                            <th class="sort pointer-cursor" data-sort="color">Part Name</th>
                            <th class="sort pointer-cursor" data-sort="quantity">Quantity In Stock</th>
                            <th>Operations</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table>

                    <!-- New Part button-->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#part_modal">
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
                            <th class="sort pointer-cursor" data-sort="type">MaterialID</th>
                            <th class="sort pointer-cursor" data-sort="color">Material Name</th>
                            <th class="sort pointer-cursor" data-sort="quantity">Quantity in stock</th>
                            <th>Operations</th>
                        </thead>
                        <tbody class="list">

                        </tbody>
                    </table>
                    <!-- Materials Button-->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materials_modal">
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
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="bicyle_type_input">Type</label>
                        <input id="bicyle_type_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bicyle_size_input">Size</label>
                        <input id="bicyle_size_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bicyle_color_input">Color</label>
                        <input id="bicyle_color_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bicyle_finishes_input">Finishes</label>
                        <input id="bicyle_finishes_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bicyle_grade_input">Grade</label>
                        <input id="bicyle_grade_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bicyle_quantity_input">Quantity</label>
                        <input id="bicyle_quantity_input" type="text" class="form-control" >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
                <form>
                    <div class="form-group">
                        <label for="material_name_input">Material Name</label>
                        <input id="material_name_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="material_quantity_input">Quantity</label>
                        <input id="material_quantity_input" type="text" class="form-control">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Add New Material</button>
                </div>
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
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="part_type_input">Part Name</label>
                        <input id="part_type_input" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="parts_quantity_input">Quantity</label>
                        <input id="parts_quantity_input" type="text" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add New Part</button>
            </div>
        </div>
    </div>
</div>

<!-- Javascript for edit bicycle button -->

<!-- Everything After This point to be deleted-->
<!-------------------------------------------------------------------------------------------------------------------------->
<script>
    function editBicycle(id){
        $('#bicycle_modal').modal('show');
        alert('edit bicycle id ' + id);
    }

    bicycleOptions = {
        valueNames: ["type", "size", "color", "finishes", "grade", "quantity"],
        item: function(item) {
            return `
        <tr>
        <td class="type"></td>
        <td class="size"></td>
        <td class="color" ></td>
        <td class="finishes"></td>
        <td class="grade"></td>
        <td class="quantity"></td>                            
        <td>
                <button class="btn btn-primary" onClick="editBicycle(${item.id})">
                Edit
                </button>
                <button class="btn btn-danger" onClick="alert('delete id ' + ${item.id})">
                Delete
                </button>
            </td>
        </tr>      
        `
        },
        pagination: true,
        page: 5
    }

    const bicycles = [{
            id:1,
            type: "mountain",
            size: "big",
            color: "red",
            finishes: "good",
            grade: "A",
            quantity: 10
        },
        {
            id:2,
            type: "street",
            size: "small",
            color: "blue",
            finishes: "bad",
            grade: "C",
            quantity: 1
        },
        {
            id:3,
            type: "street",
            size: "medium",
            color: "yellow",
            finishes: "very good",
            grade: "A+",
            quantity: 12
        },
        {
            id:4,
            type: "mountain",
            size: "big",
            color: "red",
            finishes: "good",
            grade: "A",
            quantity: 10
        },
        {
            id:5,
            type: "mountain",
            size: "big",
            color: "red",
            finishes: "good",
            grade: "A",
            quantity: 10
        },
        {
            id:6,
            type: "mountain",
            size: "big",
            color: "red",
            finishes: "good",
            grade: "A",
            quantity: 10
        },
    ]

    var bicyleList = new List('bicycles', bicycleOptions, bicycles);
</script>

<script>
    function editParts(id) {
        $('#part_modal').modal('show');
        alert('edit bicyle id ' + id);
    }

    partsOptions = {
        valueNames: ["type", "color", "quantity"],
        item: function(item) {
            return `
        <tr>
            <td class="type"></td>
            <td class="color"></td>
            <td class="quantity"></td>
            <td>
                <button class="btn btn-primary" onClick="editParts(${item.id})">
                Edit
                </button>
                <button class="btn btn-danger" onClick="alert('delete id ' + ${item.id})">
                Delete
                </button>
            </td>
        </tr>    
        `
        },
        pagination: true,
        page: 5
    }

    const parts = [{
            id: 1,
            type: "mountain",
            color: "red",
            quantity: 10
        },
        {
            id: 2,
            type: "mountain",
            color: "red",
            quantity: 10
        },
        {
            id: 3,
            type: "mountain",
            color: "red",
            quantity: 10
        },
        {
            id: 4,
            type: "street",
            color: "green",
            quantity: 20
        },
        {
            id: 5,
            type: "mountain",
            color: "red",
            quantity: 10
        },

    ]

    var bicyleList = new List('parts', partsOptions, parts);
</script>







@endsection