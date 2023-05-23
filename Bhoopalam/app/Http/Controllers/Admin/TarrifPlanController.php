<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TarrifPlan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TarrifPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TarrifPlan::orderBy('id','desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class=' . 'btn-group btn-sm' . '>';

                    $btn =  $btn . '<a title="Edit" href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editData"><i class="fadeIn animated bx bx-edit text-white"></i></a>';

                    $btn =  $btn . '<a title="View" data-id="' . $row->id . '" href="javascript:void(0)"  class="btn btn-primary btn-sm viewData"><i class="fadeIn animated lni lni-eye text-white"></i></a>';


                    $btn = $btn . ' <a title="Delete" href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteData"><i class="fadeIn animated bx bx-trash text-white" data-feather="delete"></i></a>';

                    if ($row->status == 'active') {
                        $btn = $btn . '<div class="onoffswitch"><input type="checkbox" id="togBtnn' . $row->id . '" value="' . $row->id . '" name="toggle" class="onoffswitch-checkbox" tabindex="0" checked><label class="onoffswitch-label" for="togBtnn' . $row->id . '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div><span class="alrtU' . $row->id . '"></span>';
                    } else {
                        $btn = $btn . '<div class="onoffswitch"><input type="checkbox" id="togBtnn' . $row->id . '" value="' . $row->id . '" name="toggle" class="onoffswitch-checkbox" tabindex="1"><label class="onoffswitch-label" for="togBtnn' . $row->id . '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div><span class="alrtU' . $row->id . '"></span>';
                    }
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])->make(true);
        }
        return view('admin.tarrif.index');
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
        // 'statname','oprtype','oprname','plantype','amount','oldamt','vdays','description','slno','boxtype','orn','status'
        //return dd($request->all());
        $input = $request->all();
        $data =  TarrifPlan::updateOrCreate(
            ['id' => $request->id],
            [
                'statname' => $request->statname,
                'oprtype' => $request->oprtype,
                'oprname' => $request->oprname,
                'plantype' => $request->plantype,
                'amount' => $request->amount,
                'oldamt' => $request->oldamt,
                'vdays' => $request->vdays,
                'description' => $request->description,
                'slno' => $request->slno,
                'boxtype' => $request->boxtype,
                'orn' => $request->orn,
                'status' => $request->status,
            ]
        );
        if ($data) {
            return response()->json(['msg' => 'Data Saved Successfully.', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something Wrong', 'status' => true]);
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
        $profile = TarrifPlan::where('id', $id)->first();
        return view('admin.accounts.client-profile', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $connection = TarrifPlan::find($id);
        return response()->json($connection);
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

        $update = TarrifPlan::where('id', $id)->update([
            $request->column => $request->value
        ]);
        if ($update) {
            return response()->json(['msg' => '<span class="badge badge-succcess">updated</span>', 'status' => true]);
        } else {
            return response()->json(['msg' => 'somethig went wrong', 'status' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TarrifPlan::where('id', $id)->update(['status' => 'deleted']);
        if ($data) {
            return response()->json(['msg' => 'Data deleted successfully', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something wrong', 'status' => false]);
        }
    }



    public function status(Request $request)
    {
        //dd($request->all());
        if ($request->mode == 'true') {
            TarrifPlan::where('id', $request->id)->update(['status' => 'active']);
            return response()->json(['msg' => 'Now Data status is activated', 'status' => true]);
        } else {
            TarrifPlan::where('id', $request->id)->update(['status' => 'inactive']);
            return response()->json(['msg' => 'Now Data status is de-activated', 'status' => false]);
        }
    }

}
