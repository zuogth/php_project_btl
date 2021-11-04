<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table='comments';
    public $timestamps=false;

    protected $fillable=[
        'product_id',
        'user_id',
        'cmt_datetime',
        'context',
        'stars'
    ];

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
