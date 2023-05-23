<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\MediaIcon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;

class HomePageController extends Controller
{
    //
    public function index()
    {
        $post = BlogPost::where('status', 'publish')->orderBy('id', 'DESC')->take(3)->get();
        $products = Product::where('status', 'publish')->orderBy('id', 'DESC')->take(8)->get();
        $category = BlogCategory::all();
        $Slider = Slider::orderBy('position','DESC')->get();
        return view('frontend.index', ['media' => MediaIcon::first(), 'categories' => $category, 'latests' => $post, 'slider' => $Slider, 'products'=>$products]);
    }





    // search
//    public function autocomplete(Request  $request)
//    {
//
//        if (!empty($request->value)) {
//            $data = Product::select("product_title", "product_slug", "product_img")
//                ->where("product_title", "LIKE", "%{$request->value}%")
//                ->take(8)->get();
//
//            return view('search.search-list', compact('data'));
//        }
//    }


   public function packagesIndex()
    {
        $products = Product::where('status', 'publish')->latest()->paginate(8);
        $productCategory = ProductCategory::orderBy('id', 'desc')->get();

//        return $products;
        return view('frontend.products', ['allProducts' => $products, 'productCategories' => $productCategory]);
    }

    function getProductBySlug($slug)
    {
        $products = Product::where('product_slug', $slug)->first();
        $similar = Product::where('status', 'publish')->take(8)->get();
        $productCategory = ProductCategory::orderBy('id', 'desc')->get();
        $getCatName = ProductCategory::where('id', $products->product_cat)->first();


        return view('frontend.product-view', ['products' => $products, 'productCategories' => $productCategory, 'similars' => $similar, 'getCatName' => $getCatName]);
    }

    function productCategoryWise($catSlug)
    {
        $getCatId = ProductCategory::where('product_cat_slug', $catSlug)->first();
        $products = Product::where('product_cat', 'LIKE','%'.$getCatId->id.'%')->where('status', 'publish')->paginate(12);
        $productCategory = ProductCategory::orderBy('id', 'desc')->get();


        return view('frontend.product-category', ['products' => $products, 'productCategories' => $productCategory, 'category' => $getCatId]);
    }
}
