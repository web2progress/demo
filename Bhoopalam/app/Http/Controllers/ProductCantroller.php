<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductCategory;
use Intervention\Image\Facades\Image;

class ProductCantroller extends Controller
{

    function index()
    {
        $product = Product::orderBy('id', 'DESC')->paginate(6);
        $allproduct = Product::count();
        $publish = Product::where('status', 'publish')->count();
                                                                                                                                                                                                                                                         $draft = Product::where('status', 'draft')->count();

        // $productPaginate = Product::where('status', 'publish')->orderBy('id', 'DESC')->paginate(3);
        return view('admin.product', ['products' => $product, 'allproduct' => $allproduct, 'publish' => $publish, 'draft' => $draft]);
    }
 // searchproduct
 public function searchProduct(Request $request)
 {
     /* Process ajax request */

     $draw = $request->get('draw');
     $start = $request->get("start");
     $rowperpage = $request->get("length"); // total number of rows per page

     $columnIndex_arr = $request->get('order');
     $columnName_arr = $request->get('columns');
     $order_arr = $request->get('order');
     $search_arr = $request->get('search');

     $columnIndex = $columnIndex_arr[0]['column']; // Column index
     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
     $searchValue = $search_arr['value']; // Search value

     // Total records
     $totalRecords = Product::select('count(*) as allcount')->count();
     $totalRecordswithFilter = Product::select('count(*) as allcount')->where('product_title', 'like', '%' . $searchValue . '%')->count();

     // Get records, also we have included search filter as well
     $records = Product::orderBy($columnName, $columnSortOrder)
         ->Where('product_title', 'like', '%' . $searchValue . '%')
         ->orWhere('meta_keyword', 'like', '%' . $searchValue . '%')
         ->orWhere('product_short_description', 'like', '%' . $searchValue . '%')
         ->select('*')
         ->skip($start)
         ->take($rowperpage)
         ->get();

     $data_arr = array();

     foreach ($records as $record) {
         if ($record->status == 'publish') {
                $status ='<span class="text-success">'.$record->status.'</span>';
              }
              else{
                 $status ='<span class="text-danger">'.$record->status.'</span>';
              }

             $data_arr[] = array(
                 "id" => $record->id,
                 "product_title" => $record->product_title,
                 "product_slug" => $record->product_slug,
                 "meta_keyword" => $record->meta_keyword,
                 "product_short_description" => $record->product_short_description,
                 "product_view" => $record->product_view,
                 "status" => $status,
                 "created_at" => $record->created_at->format('d-M-Y'),
                 "action" => '<div class="d-flex justify-content-center">
      <a href="/admin/editProduct/' . $record->id . '" class="btn btn-sm btn-info text-light"><i class="lni lni-pencil"></i></a>
          <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '"><i class="lni lni-trash"></i>
          </button>
  </div>',
             );
         }

     $response = array(
         "draw" => intval($draw),
         "iTotalRecords" => $totalRecords,
         "iTotalDisplayRecords" => $totalRecordswithFilter,
         "aaData" => $data_arr,
     );

     echo json_encode($response);
 }

  //create Product
  public function createProduct(Request $request)
  {

      $validator = Validator::make($request->all(), [
          'product_title' => 'required|unique:products,product_title',
          'product_slug' => 'required|unique:products,product_slug'
      ]);
      //Check for validation
      if ($validator->fails()) {

          // $messages = $request->messages(); // get the error message.


          return Redirect::back()->withErrors($validator)->withInput();
          // return redirect('/category')->withErrors($validator);
      } else {
          //do your actual operation here.
          $createproduct = new Product();
          $input = $request->all();
          $createproduct->product_title = $request->product_title;
          $createproduct->product_slug = $request->product_slug;
          $createproduct->status = 'draft';
          if ($createproduct->save()) {
              // get product
              $products = Product::where('product_slug', $request->product_slug)->first();
              return redirect('/admin/editProduct/' . $products->id)->with('success', 'Url  successfully created!');
          }
      }
  }
 // editProduct
 public function editProduct($id)
 {
     $products = Product::where('id', $id)->first();

     $ProductCategoryById = ProductCategory::where('id', $products->product_cat)->first();

     $ProductCategory = ProductCategory::all();

     return view('admin.product', ['editProduct' => $products, 'productCategory' => $ProductCategory, 'productsById' => $ProductCategoryById]);
 }

 //updateProduct
 function updateProduct(Request $req)
 {

     $table = Product::where('id', $req->id)->first();
     $table->{$req->column_title} = $req->value;
     $table->update();
     return ('Udated');
     //  return  with('success', 'country has been updated');
 }
 // productImageUpload
 public function productImageUpload(Request $request)
 {


     $validator = Validator::make($request->all(), [
         'id' => 'required',
         'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);
     $input = $request->all();
     // product images folder
     $path = 'images/products';

     if ($validator->fails()) {
         return Redirect::back()->withErrors($validator)->withInput();
     } else {
         $table = Product::where('id', $request->id)->first();
         if (!empty($table->product_img)) {
             //File::delete(public_path($path . '/' . $table->product_img));
             $thumbname = pathinfo($table->product_img, PATHINFO_FILENAME) . '.' . $request->product_img->extension();
         } else {
             $thumbname = time() . '.' . $request->product_img->extension();
         }

         // rezize imamge
         $image = $request->product_img;
         $filePath = public_path('images/products/thumbnails');
         $img = Image::make($image->path());
         $img->resize(400, 400, function ($const) {
             $const->aspectRatio();
         })->save($filePath . '/' . $thumbname);


         // Store product original images
         $request->product_img->move(public_path($path), $thumbname);
         $table->product_img = $thumbname;
         $table->update();
         return response('done');
     }
 }
 // deleteCat
 public function deleteProduct(Request $req)
 {
     $table = Product::where('id', $req->id);
     $table->delete();
     return ('Your imaginary Product has been deleted');
 }
}
