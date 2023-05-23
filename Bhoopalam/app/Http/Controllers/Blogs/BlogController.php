<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\Comment;
use App\Models\CommentMultilabel;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function getpost($postSlug)
    {
        $Posts = BlogPost::where('slug', $postSlug)->first();
        $category = BlogCategory::all();
        $tag = BlogTag::all();

        // next prev
        $previous = BlogPost::where('slug', '<', $Posts->slug)->Where('status', 'publish')->orderby('id', 'DESC')->max('slug');
        $next = BlogPost::where('slug', '>', $Posts->slug)->Where('status', 'publish')->orderby('id', 'DESC')->min('slug');

        $blogs = BlogPost::paginate(5);
        $getcomment = Comment::where('post_id', $Posts->id)->where('status', 'active')->get();

        //   view count
        $count = 1 + $Posts->view;
        $Posts->view = $count;
        $Posts->update();

        return view('frontend/blogs/post-view', ['posts' => $Posts, 'blogs' => $blogs, 'categories' => $category, 'tags' => $tag, 'getcomments' => $getcomment,])->with('previous', $previous)->with('next', $next);
    }

    // blog page
    public function index()
    {

        $post = BlogPost::where('status', 'publish')->orderBy('id', 'DESC')->get();
        $postPaginate = BlogPost::where('status', 'publish')->orderBy('id', 'DESC')->paginate(3);

        // feature post
        // start
        $getFeature = BlogCategory::where('slug', 'feature')->first();;
        $feature = BlogPost::where('categories', 'LIKE', '%' . $getFeature->id . '%')->where('status', 'publish')->orderBy('id', 'DESC')->get();
        //   end


        $category = BlogCategory::all();
        $blogs = BlogPost::paginate(5);


        return view('frontend.blogs.index', ['categories' => $category, 'posts' => $post, 'blogs' => $blogs, 'postPaginates' => $postPaginate, 'postFeatures' => $feature,]);
    }

    function comments()
    {
        $comments = Comment::paginate(10);
        return view('admin.blog.comments', ['comments' => $comments,]);
    }
    // adds comment
    public function postComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required'
        ]);
        //Check for validation
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            //do your actual operation here.
            $catCreate = new Comment();
            $catCreate->post_id = $request->id;
            $catCreate->name = $request->name;
            $catCreate->email = $request->email;
            $catCreate->comment = $request->comment;
            $catCreate->status = 'active';
            $catCreate->save();

            return Redirect::back()->with('success', 'Thank you for your comment');
        }
    }

    // delete comment
    function delComment(Request $req)
    {

        $comments = Comment::where('id', $req->id);
        $comments->delete();
        return ('Comment has been deleted');
    }

    function commentAprove(Request $request)
    {

        //dd($request->all());
        if ($request->mode == 'true') {
            DB::table('comments')->where('id', $request->id)->update(['status' => 'active']);
            return response()->json(['msg' => 'Comment Approved', 'status' => true]);
        } else {
            DB::table('comments')->where('id', $request->id)->update(['status' => 'inactive']);
            return response()->json(['msg' => 'Comment Dis-approved', 'status' => false]);
        }
    }

    // get categorypost
    function getCategory($catURL)
    {
        $categoryWise = BlogCategory::where('slug', $catURL)->first();
        $PostCategory = BlogPost::where('categories', 'LIKE', '%' . $categoryWise->id . '%')->where('status', 'publish')->orderBy('id', 'DESC')->paginate(7);
        $category = BlogCategory::all();
        return view('frontend.blogs.category', ['categories' => $category, 'postCategories' => $PostCategory, 'categoryWise' => $categoryWise]);
    }

    public function commentReply(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cid' => 'required',
            'reply_comment' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['msg' => 'something went wrong!', 'status' => false]);
        }else{
            $check = CommentMultilabel::where('comment_id', decrypt($request->cid))->count();
            if($check>0){
                $updateReply = CommentMultilabel::where('comment_id', decrypt($request->cid))->update([
                    'comments'=>$request->reply_comment
                ]);
                if($updateReply){
                    return response()->json(['msg' => 'Reply updated successfully!', 'status' => true]);
                }else{
                    return response()->json(['msg' => 'Something went wrong..!', 'status' => false]);
                }
            }else{
                $createReply = new CommentMultilabel();
                $createReply->comment_id=decrypt($request->cid);
                $createReply->comments=$request->reply_comment;
                $createReply->save();
                if($createReply->save()){
                    return response()->json(['msg'=>'Reply submitted successfully!', 'status'=>true]);
                }else{
                    return response()->json(['msg'=>'Something went wrong','status'=>false]);
                }
            }
        }
    }
}
