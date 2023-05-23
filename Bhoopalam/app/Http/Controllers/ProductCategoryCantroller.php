<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use Facade\Ignition\Solutions\MakeViewVariableOptionalSolution;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductCategoryCantroller extends Controller
{
    //
    function index()
    {
        $productCat = ProductCategory::orderby('id', 'DESC')->paginate(6);
        $allProductCat = ProductCategory::all()->count();
        return view('admin.product-category', ['products' => $productCat, 'allProductCat' => $allProductCat]);
    }

    // add actegory
    public function addProductCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cat_title' => 'required|unique:product_categories,product_cat_title',
            'cat_slug' => 'required|unique:product_categories,product_cat_slug',
            'cat_keyword' => 'nullable|string|required_if:product_cat_keyword,true',
            'cat_description' => 'nullable|string|required_if:product_cat_description,true'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/category')->withErrors($validator);
        } else {
            //do your actual operation here.
            $catCreate = new ProductCategory();
            $catCreate->product_cat_title = $request->cat_title;
            $catCreate->product_cat_slug = $request->cat_slug;
            $catCreate->product_cat_keyword = $request->cat_keyword;
            $catCreate->product_cat_description = $request->cat_description;
            $catCreate->save();

            return redirect('/admin/product-categories')->with('success', 'Category  successfully created!');
        }
    }

    // deleteCat
    public function deleteProductCat(Request $req)
    {
        //  check post
        $products = Product::where('product_cat', $req->id)->count();
        if ($products > 0) {
            return ('Sorry..! we cant delete This category. Because there are ' . $products . ' products in this category First delete this post or change category.');
        } else {
            $table = ProductCategory::where('id', $req->id);
            $table->delete();
            return ('Your imaginary Category has been deleted');
        }
    }

    function updateProductCategory(Request $req)
    {
        $table = ProductCategory::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Data Changed');
        //  return  with('success', 'country has been updated');
    }
}
