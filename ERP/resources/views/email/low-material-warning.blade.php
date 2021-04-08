@component('mail::message')
Hello {{$user->first_name}} {{$user->last_name}},

There are currently some items in the warehouse that are low in stock. Please make sure to restock them as soon as possible.
See below for a detailed list.

<br><br>

# Material Details
@component('mail::table')
    | Material| Unit Cost | <span style="color:red">**Current Stock**</span> |
| ------------- |:-------------:| -----:|
@foreach($materialCollection as $mat)
| {{$mat->material_name}}  | {{$mat->cost}}$ | <span style="color:red">**{{$mat->material_quantity_in_stock}}**</span>|
@endforeach
@endcomponent
<hr>
<sub>You are receiving this email because you are registered as an Inventory Manager in the ERP System</sub>
@endcomponent
