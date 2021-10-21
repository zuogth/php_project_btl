<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table='product';
    public $timestamps=false;

    protected $fillable=[
        'productname',
        'description',
        'category_id',
        'brand_id',
        'pricesell',
        'priceentry',
        'productcode',
        'status',
        'images'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
