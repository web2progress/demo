<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\BlogPostCategory;
use App\Models\BlogPostTag;
use App\Models\Modal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class BlogPostController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allpost = BlogPost::count();
        $publish = BlogPost::where('status', 'publish')->count();
        $draft = BlogPost::where('status', 'draft')->count();

        $category = BlogCategory::all();
        // $country = country::paginate(10);
        return view('admin.blog.post', ['categories' => $category, 'allpost' => $allpost, 'publish' => $publish, 'draft' => $draft]);
    }

    // search post
    public function searchPost(Request $request)
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
        $totalRecords = BlogPost::where('status', 'publish')->orWhere('status', 'draft')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = BlogPost::where('status', 'publish')->orWhere('status', 'draft')->select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = BlogPost::where('status', 'publish')->orWhere('status', 'draft')->orderBy($columnName, $columnSortOrder)
            ->Where('blog_posts.title', 'like', '%' . $searchValue . '%')
            ->orWhere('blog_posts.keyword', 'like', '%' . $searchValue . '%')
            ->orWhere('blog_posts.description', 'like', '%' . $searchValue . '%')
            ->select('blog_posts.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            if ($record->status == 'publish' || $record->status == 'draft') {

                if (empty($record->keyword)) {
                    $keyword = '<div contenteditable="true" class="update bg-light" data-id="' . $record->id . '" data-column="keyword">' . $record->keyword . '</div>';
                } else {
                    $keyword = '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="keyword">' . $record->keyword . '</div>';
                }
                // desc
                if (empty($record->description)) {
                    $description = '<div contenteditable="true" class="update bg-light" data-id="' . $record->id . '" data-column="description">' . $record->description . '</div>';
                } else {
                    $description = '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="description">' . $record->description . '</div>';
                }





                $data_arr[] = array(
                    "id" => $record->id,

                    "title" => '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="title">' . $record->title . '</div>',

                    "slug" => '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="slug">' . $record->slug . '</div>',

                    "keyword" => $keyword,

                    "description" => $description,

                    "view" => $record->view,
                    "status" => $record->status,
                    "created_at" => $record->created_at->format('d-M-Y'),
                    "action" => '<div class="d-flex justify-content-center">
               <a href="blog-post/' . $record->id . '/edit" class="btn btn-sm btn-info text-light"><i class="lni lni-pencil"></i></a>
                   <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '"><i class="lni lni-trash"></i>
                   </button>
           </div>',
                );
            }
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
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
            'title' => 'required|unique:blog_posts,title',
            'slug' => 'required|unique:blog_posts,slug'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/category')->withErrors($validator);
        } else {
            //do your actual operation here.
            $createPost = new BlogPost();
            $input = $request->all();
            $createPost->title = $request->title;
            $createPost->slug = $request->slug;
            $createPost->user_id = Auth()->user()->id;

            if ($createPost->save()) {
                // get post
                $Posts = BlogPost::where('slug', $request->slug)->first();

                return redirect('admin/blog-post/' . $Posts->id . '/edit')->with('success', 'Url  successfully created!');
            }
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


        $Posts = BlogPost::where('id', $id)->first();
        $category = BlogCategory::all();
        $tag = BlogTag::all();
        $modals = Modal::where('status', 'publish')->get();

        return view('admin.blog.edit', ['editPosts' => $Posts, 'categories' => $category,   'tags' => $tag, 'modals' => $modals]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    // search post
    public function searchDraft(Request $request)
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
        $totalRecords = BlogPost::where('status', 'draft')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = BlogPost::where('status', 'draft')->select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = BlogPost::where('status', 'draft')->orderBy($columnName, $columnSortOrder)
            ->Where('blog_posts.title', 'like', '%' . $searchValue . '%')
            ->orWhere('blog_posts.keyword', 'like', '%' . $searchValue . '%')
            ->orWhere('blog_posts.description', 'like', '%' . $searchValue . '%')
            ->select('blog_posts.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            if ($record->status == 'draft') {
                $data_arr[] = array(
                    "id" => $record->id,
                    "title" => $record->title,
                    "keyword" => $record->keyword,
                    "description" => $record->description,
                    "created_at" => $record->created_at->format('d-M-Y'),
                    "action" => '<div class="d-flex justify-content-center">
                    <a href="blog-post/' . $record->id . '/edit" class="btn btn-sm btn-info text-light"><i class="lni lni-pencil"></i></a>
               <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '"><i class="lni lni-trash"></i>
               </button>
       </div>',
                );
            }
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }

    // restorePost
    function restorePost(Request $req)
    {
        $table = BlogPost::where('id', $req->id)->first();
        $table->status = 'draft';
        $table->update();

        return ('Post has been Restored');
    }
    //updatepost
    function updatePost(Request $req)
    {
        $table = BlogPost::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Udated');
        //  return  with('success', 'country has been updated');
    }

    //rePublishPost

    function rePublishPost(Request $req)
    {

        //dd($req->all());
        $publishUpdate = BlogPost::where('id', $req->id)->update([
            'title' => $req->title,
            'slug' => $req->slug,
            'content' => $req->content,
            'seo_title' => $req->seo_title,
            'keyword' => $req->keyword,
            'description' => $req->description,
            'thumbnail' => $req->thumbnail,
            'status' => $req->status,
        ]);

        if ($publishUpdate) {
            if ($req->status == 'publish') {
                return response()->json(['msg' => 'Page Published', 'status' => true]);
            } else {
                return response()->json(['msg' => 'Page move in Draft', 'status' => false]);
            }
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }



    //  upload ck images
    public function ImgUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    // upload thumbnail
    public function uploadThumbnail(Request $request)
    {
        $data = BlogPost::where('id', $request->id)->first();
        $data->thumbnail = $request->thumbnail;
        $data->update();
        if ($data->update()) {
            return ('thumbnail uploaded successfully');
        }
    }



    //PostMulticategory
    function PostMultiCategory(Request $request)
    {
        // array implode
        $categoryData = implode(', ', $request->category_id);
        $update = BlogPost::where('id', $request->id)->update([
            'categories' => $categoryData
        ]);
        if ($update) {
            return ('Update Success');
        }
    }
    //PostMultiTag
    function PostMultiTag(Request $request)
    {
        // array implode
        $tagData = implode(', ', $request->tag_id);
        $update = BlogPost::where('id', $request->id)->update([
            'tags' => $tagData
        ]);
        if ($update) {
            return ('Update Success');
        }
    }



    // draftPost
    public function draftPost(Request $req)
    {
        $table = BlogPost::where('id', $req->id)->first();
        $table->status = 'draft';
        $table->update();
        return ('Your Post has been in Draft');
    }

    // draft
    public function draft()
    {
        $allpost = BlogPost::count();
        $publish = BlogPost::where('status', 'publish')->count();
        $draft = BlogPost::where('status', 'draft')->count();
        // $country = country::paginate(10);
        return view('admin.blog.draft', ['allpost' => $allpost, 'publish' => $publish, 'draft' => $draft]);
    }


    // RecycleBin
    public function RecycleBin()
    {
        $post = BlogPost::where('status', 'recyclebin')->orderBy('id', 'DESC')->paginate(6);
        $category = BlogCategory::all();
        // $country = country::paginate(10);
        return view('admin.blog.recycle-bin', ['categories' => $category, 'posts' => $post]);
    }



    // RecycleBinPost
    public function RecycleBinPost(Request $req)
    {
        $table = BlogPost::where('id', $req->id)->first();
        $table->status = 'recyclebin';
        $table->update();
        return ('Your Post has been Move in Recycle Bin');
    }

    // deletepost
    public function deletepost(Request $req)
    {
        $table = BlogPost::where('id', $req->id);
        $table->delete();
        return ("Your imaginary post has been deleted");
    }
}
