<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $table='speciality';
    public $timestamps=false;

    public $fillable=[
        'typename',
        'typenumber',
        'mata',
        'description',
        'code',
        'typeproduct'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_speciality','speciality_id','product_id');
    }
}
