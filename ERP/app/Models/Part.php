<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'part_name',
        'part_quantity_in_stock',
        'category'
    ];

    //relates Parts to materials
    public function materials(){
        return $this->belongsToMany(Material::class);
    }

    //relates parts to bicycle
    public function bikes(){
        return $this->belongsToMany(Bike::class);
    }
}
