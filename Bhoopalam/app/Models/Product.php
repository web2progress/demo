<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
   protected $fillable = ['product_title','product_slug','product_cat','product_amount','product_mrp','product_offer','product_quantity','product_img','meta_title','meta_description','meta_keyword','meta_tags','product_short_description','product_full_description','product_view','status'];

}
