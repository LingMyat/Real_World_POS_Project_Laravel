<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;
    protected $fillable =[
        "cart_id",'user_id','product_id','qty','order_code','total'
    ];
}
