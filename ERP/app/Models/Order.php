<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'status',
        'ETA'
    ];

    //relates orders to materials
    public function materials()
    {
        return $this->belongsToMany(Material::class)->as('material_order_pivot')->withPivot('order_quantity');
    }
}
