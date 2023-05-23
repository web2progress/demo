<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = BlogTag::orderBy('id', 'DESC')->paginate(6);
        return view('admin.blog.tag', ['tags' => $tag]);
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
            'title' => 'required|unique:blog_tags,title',
            'slug' => 'required|unique:blog_tags,slug',
            'keyword' => 'nullable|string|required_if:keyword,true',
            'description' => 'nullable|string|required_if:description,true'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/tag')->withErrors($validator);
        } else {
            //do your actual operation here.
            $tagCreate = new BlogTag();
            $tagCreate->title = $request->title;
            $tagCreate->slug = $request->slug;
            $tagCreate->keyword = $request->keyword;
            $tagCreate->description = $request->description;
            $tagCreate->save();

            return redirect()->back()->with('success', 'Tag  successfully created!');
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
        $table = BlogTag::where('id', $request->id)->first();
        $table->{$request->column_title} = $request->value;
        $table->update();
        return ('Udated');
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

    // deleteTag
    public function deleteTag(Request $req)
    {
        $table = BlogTag::where('id', $req->id);
        $table->delete();
        return ('Your imaginary Category has been deleted');
    }
}
