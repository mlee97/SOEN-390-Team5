<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['profit'];

    /** 
     * Creating a many to many relationships with sales (many sales can be selling many bikes).
     * Get the bicycle associated with the sale.
     */ 
    public function bikes()
    {
        return $this->belongsToMany(Bike::class)->withPivot('bike_id', 'sale_id', 'quantity_sold')->as('bike_sale_pivot');
    }  
}
