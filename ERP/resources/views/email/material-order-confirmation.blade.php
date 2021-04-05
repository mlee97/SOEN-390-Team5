@component('mail::message')
Hello {{$user->first_name}} {{$user->last_name}},

An order for materials has been placed on {{$order->created_at}}

<br><br>

# Order Details

@component('mail::table')
| Material| Quantity Ordered |Unit Cost|
| ------------- |:-------------:| -----:|
@foreach($order->materials as $mat)
| {{$mat->material_name}}  | {{$mat->material_order_pivot->order_quantity}} | {{$mat->cost}}$ |
@endforeach
| | **TOTAL** | **{{$totalCost}}$** |
@endcomponent
<hr>
<sub>You are receiving this email because you are registered as an accountant in the ERP System</sub>
@endcomponent
