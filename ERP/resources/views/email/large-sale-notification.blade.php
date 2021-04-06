@component('mail::message')
Hello {{$user->first_name}} {{$user->last_name}},
<br/>

Congratulation! You have made a large sale!
<br/>
<br/>
<br/>
# Sale ID #{{$sale->id}} Details
<div style="display: none">{{$count=0}}</div>
@component('mail::table')
| Bike # | Bike Type | Size | Color | Finish  | Grade | Unit Price | Quantity Sold |
|:-------------| :-------------: | :-------------: | :-------------: | :-------------: | :-------------: | :-------------: | :-------------: |
@foreach($sale->bikes as $bike)
| **{{++$count}}** | {{$bike->type}} | {{$bike->size}} | {{$bike->color}} | {{$bike->finish}} | {{$bike->grade}} | {{$bike->price}} | {{$bike->bike_sale_pivot->quantity_sold}} |
@endforeach
| | | | | | | **PROFITS** | **{{$sale->profit}}$** |
@endcomponent
<hr>
<sub>You are receiving this email because you are registered as a Product Manager in the ERP System</sub>
@endcomponent
