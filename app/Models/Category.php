<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='category';
    public $timestamps = false;

    protected $fillable=[
        'categoryname',
        'parent_id',
        'categorycode',
        'status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'id','category_id');
    }
}
