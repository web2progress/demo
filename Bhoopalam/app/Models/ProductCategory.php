<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['product_cat_title', 'product_cat_slug', 'product_cat_keyword', 'product_cat_description'];
    // product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_cat', 'id');
    }
}
