<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material_name',
        'material_quantity_in_stock',
        'cost'
    ];

    //relates materials to parts
    public function parts(){
        return $this->belongsToMany(Part::class);
    }

    //relates orders to materials
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
