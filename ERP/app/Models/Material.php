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

    public function part(){
        $this->belongsToMany(Part::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
