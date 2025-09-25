<?php

namespace App\Models\admin;

use App\Models\Admin\Brand;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['name', 'price', 'rating', 'brand_id', 'category_id', 'description', 'quantity', 'image', "main_image"];



    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    // Product belongs to a category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
