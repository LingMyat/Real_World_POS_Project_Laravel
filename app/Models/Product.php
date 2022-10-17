<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'category_id','name','description','image','price','view_count','waiting_time'
    ];
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
