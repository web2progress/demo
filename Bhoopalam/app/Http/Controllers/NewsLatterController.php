<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\NewsLatter;
use App\Exports\NewsLatterExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class NewsLatterController extends Controller
{

    //view news latter
    public function index()
    {
        return view('admin.news-latter');
    }

    // search getNewslatter
    public function SearchNewslatter(Request $request)
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
        $totalRecords = NewsLatter::select('count(*) as allcount')->count();
        $totalRecordswithFilter = NewsLatter::select('count(*) as allcount')->where('email', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = NewsLatter::orderBy($columnName, $columnSortOrder)
            ->Where('email', 'like', '%' . $searchValue . '%')
            ->select('*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $data_arr[] = array(
                "id" => $record->id,
                "email" => $record->email,
                "created_at" => $record->created_at->format('d-M-Y'),
                "action" => '
               <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '"><i class="lni lni-trash"></i>
               </button>',
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


    //add news latter
    function sendNewsLatter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newsLatter' => 'required|email|unique:news_latters,email',
        ]);
        //Check for validation
        if ($validator->fails()) {
            return ('<span class="text-danger">' . $validator->errors()->first() . '</span>');
        } else {
            //do your actual operation here.
            $emailCreate = new NewsLatter();
            $emailCreate->email = $request->newsLatter;
            $emailCreate->save();

            return ('<span class="text-success">Thank you for your Subscription</span>');
        }
    }

    // deleteCat
    public function deleteNewsLatter(Request $req)
    {
        $table = NewsLatter::where('id', $req->id);
        $table->delete();
        return ('Your imaginary Category has been deleted');
    }

    //download as excel
    function excel()
    {
      $rand = rand(10000,999999);
      return Excel::download(new NewsLatterExport, $rand.'-news-latter.xlsx');

    }
}
