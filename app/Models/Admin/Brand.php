<?php

namespace App\Models\Admin;

use App\Models\admin\product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{


    protected $fillable = ["name"];

    public function products()
    {


        return $this->hasMany(product::class, "brand_id", "id");
    }
}
