<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use DataTables;
class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Facility::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class=' . 'd-flex' . '>';
                    $btn =  $btn . '<a href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editFacility"><i class="fadeIn animated bx bx-edit text-white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteFacility"><i class="fadeIn animated bx bx-trash text-white" data-feather="delete"></i></a>';

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
        return view('admin.facilities.index');
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
        //return dd($request->all());
        $input = $request->all();
        $data =  Facility::updateOrCreate($input);
        if ($data) {
            return response()->json(['msg' => 'Facility saved successfully.', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something wrong', 'status' => true]);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility = Facility::find($id);
        return response()->json($facility);
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
        $data = Facility::find($id)->delete();
        if ($data) {
            return response()->json(['msg' => 'Facility deleted successfully', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something wrong', 'status' => true]);
        }
    }



    public function status(Request $request)
    {
        //dd($request->all());
        if ($request->mode == 'true') {
            Facility::where('id', $request->id)->update(['status' => 'active']);
            return response()->json(['msg' => 'Now facility status is activated', 'status' => true]);
        } else {
            Facility::where('id', $request->id)->update(['status' => 'inactive']);
            return response()->json(['msg' => 'Now facility status is de-activated', 'status' => false]);
        }
    }
}
