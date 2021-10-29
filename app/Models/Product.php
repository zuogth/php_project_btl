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
        'content',
        'category_id',
        'brand_id',
        'pricesell',
        'priceentry',
        'productcode',
        'status',
        'images',
        'discount'
    ];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class,'product_speciality','product_id','speciality_id');
    }

    public function bills(){
        return $this->belongsToMany(Bill::class,'product_bill','product_id','bill_id')
            ->withPivot('id','quantily');
    }
}
