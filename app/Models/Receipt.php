<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $table='receipt';
    public $timestamps=false;

    public $fillable=[
        'user_id',
        'receipt_date',
        'totalprice',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_receipt','receipt_id','product_id')
            ->withPivot('id','quantily');
    }
}
