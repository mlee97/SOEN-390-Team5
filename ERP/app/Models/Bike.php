<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'size',
        'color',
        'finish',
        'grade',
        'quantity_in_stock',
        'price'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function parts(){
        return $this->belongsToMany(Part::class);
    }

}
