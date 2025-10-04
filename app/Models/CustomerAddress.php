<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    
    protected $fillable=["name","mobile_no","pincode","locality","address","city","state","landmark","alternate_number","customer_id"];
}
