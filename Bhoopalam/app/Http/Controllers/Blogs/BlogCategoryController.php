<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class BlogCategoryController extends Controller
{

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = BlogCategory::orderBy('id', 'DESC')->paginate(6);
        return view('admin.blog.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:blog_categories,title',
            'slug' => 'required|unique:blog_categories,slug',
            'keyword' => 'nullable|string|required_if:keyword,true',
            'description' => 'nullable|string|required_if:description,true'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/category')->withErrors($validator);
        } else {
            //do your actual operation here.
            $catCreate = new BlogCategory();
            $catCreate->title = $request->title;
            $catCreate->slug = $request->slug;
            $catCreate->keyword = $request->keyword;
            $catCreate->description = $request->description;
            $catCreate->save();

            return redirect()->back()->with('success', 'Category  successfully created!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table = BlogCategory::where('id', $request->id)->first();
        $table->{$request->column_title} = $request->value;
        $table->update();
        return ('Data Changed');
        //  return  with('success', 'country has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    // deleteCat
    public function deleteCat(Request $req)
    {
        $table = BlogCategory::where('id', $req->id);
        $table->delete();
        return ('Your imaginary Category has been deleted');
    }


}
