<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table='bill';
    public $timestamps=false;

    protected $fillable=[
        'user_id',
        'bill_date',
        'totalprice',
        'deliverytime',
        'status'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_bill','bill_id','product_id')
                    ->withPivot('id','quantily');
    }
}
