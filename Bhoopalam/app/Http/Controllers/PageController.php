<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index($slug)
    {
        $getPage_count = Page::count();
        $getPage = Page::where('slug', $slug)->first();

        //   view count
        $count = 1 + $getPage->view;
        $getPage->view = $count;
        $getPage->update();


        return view('frontend.page-view', ['pages' => $getPage,]);
    }

    public function page()
    {
        $allpage = Page::count();
        $publish = Page::where('status', 'publish')->count();
        $draft = Page::where('status', 'draft')->count();

        // $country = country::paginate(10);
        return view('admin.page.index', ['allpage' => $allpage, 'publish' => $publish, 'draft' => $draft]);
    }

    // search all page
    public function searchPage(Request $request)
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
        $totalRecords = Page::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Page::select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Page::orderBy($columnName, $columnSortOrder)
            ->Where('pages.title', 'like', '%' . $searchValue . '%')
            ->orWhere('pages.keyword', 'like', '%' . $searchValue . '%')
            ->orWhere('pages.description', 'like', '%' . $searchValue . '%')
            ->select('pages.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
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
           <a target="_blank" href="/page/' . $record->slug . '" class="btn btn-sm btn-success text-light"><i class="lni lni-eye"></i></a>
                <a href="/admin/editPage/' . $record->id . '" class="btn btn-sm btn-info text-light"><i class="lni lni-pencil"></i></a>
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

    // search darft page
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
        $totalRecords = Page::where('status', 'draft')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = Page::where('status', 'draft')->select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Page::where('status', 'draft')->orderBy($columnName, $columnSortOrder)
            ->Where('pages.title', 'like', '%' . $searchValue . '%')
            ->orWhere('pages.keyword', 'like', '%' . $searchValue . '%')
            ->orWhere('pages.description', 'like', '%' . $searchValue . '%')
            ->select('pages.*')
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
           <a href="/editPage/' . $record->id . '" class="btn btn-sm btn-danger text-light"><i class="fas fa-edit"></i></a>
               <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '"><i class="fas fa-trash"></i>
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


    //create
    public function createTitle(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:pages,title',
            'slug' => 'required|unique:pages,slug'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/category')->withErrors($validator);
        } else {
            //do your actual operation here.
            $createPage = new Page();
            $input = $request->all();
            $createPage->title = $request->title;
            $createPage->slug = $request->slug;
            $createPage->status = 'draft';
            if ($createPage->save()) {
                // get page
                $Pages = Page::where('slug', $request->slug)->first();
                return redirect('/admin/editPage/' . $Pages->id)->with('success', 'Url  successfully created!');
            }
        }
    }
    // editPage
    public function editPage($id)
    {
        $Pages = Page::where('id', $id)->first();

        return view('admin.page.page-editor', ['editPages' => $Pages]);
    }
    // restorePage


    //updatepage
    function updatepage(Request $req)
    {
        $table = Page::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Udated');
        //  return  with('success', 'country has been updated');
    }
    //savePage
//savePage
function rePublishPage(Request $req)
{
  // dd($req->all());
    $publishUpdate = Page::where('id', $req->id)->update([
        'title' => $req->title,
        'slug' => $req->slug,
        'content' => $req->content,
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


    // upload thumbnail
    public function pageUploadThumbnail(Request $request)
    {
        $data = Page::where('id', $request->id)->first();
        $data->thumbnail = $request->thumbnail;
        $data->update();
        if ($data->update()) {
            return ('thumbnail uploaded successfully');
        }
    }



    // draftPage
    public function draftPage(Request $req)
    {
        $table = Page::where('id', $req->id)->first();
        $table->status = 'draft';
        $table->update();
        return ('Your Page has been in Draft');
    }

    // draft
    public function draft()
    {
        $allpage = Page::count();
        $publish = Page::where('status', 'publish')->count();
        $draft = Page::where('status', 'draft')->count();
        // $country = country::paginate(10);
        return view('admin.draft', ['allpage' => $allpage, 'publish' => $publish, 'draft' => $draft]);
    }


    // RecycleBin
    public function RecycleBin()
    {
        $page = Page::where('status', 'recyclebin')->orderBy('id', 'DESC')->paginate(6);
        // $country = country::paginate(10);
        return view('admin.recycle-bin', ['pages' => $page]);
    }
    // RecycleBinPage
    public function RecycleBinPage(Request $req)
    {
        $table = Page::where('id', $req->id)->first();
        $table->status = 'recyclebin';
        $table->update();
        return ('Your Page has been Move in Recycle Bin');
    }

    // deletepage
    public function deletePagePost(Request $req)
    {
        $table = Page::where('id', $req->id);
        $table->delete();
        return ("Your imaginary page has been deleted");
    }

    public function savePage(Request $request)
    {
        $table = Page::where('id', $request->id)->first();

        $table->html = $request->htmldata;
        $table->css = $request->cssdata;
        $table->js = $request->jsdata;
        $table->update();
        if ($table->update()) {
            return ('success');
        }
    }


}
