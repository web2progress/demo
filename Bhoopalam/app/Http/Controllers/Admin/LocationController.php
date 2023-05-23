<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Laravel\Ui\Presets\React;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Location::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class=' . 'd-flex' . '>';
                    $btn =  $btn . '<a href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editLocation"><i class="fadeIn animated bx bx-edit text-white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-bs-toggle="tooltip" data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteLocation"><i class="fadeIn animated bx bx-trash text-white" data-feather="delete"></i></a>';

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
        return view('admin.locations.index');
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
        $data =  Location::updateOrCreate($input);
        if ($data) {
            return response()->json(['msg' => 'Location saved successfully.', 'status' => true]);
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
        $location = Location::find($id);
        return response()->json($location);
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
        $data = Location::find($id)->delete();
        if ($data) {
            return response()->json(['msg' => 'Location deleted successfully', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something wrong', 'status' => true]);
        }
    }



    public function status(Request $request)
    {
        //dd($request->all());
        if ($request->mode == 'true') {
            Location::where('id', $request->id)->update(['status' => 'active']);
            return response()->json(['msg' => 'Now location status is activated', 'status' => true]);
        } else {
            Location::where('id', $request->id)->update(['status' => 'inactive']);
            return response()->json(['msg' => 'Now location status is de-activated', 'status' => false]);
        }
    }
}
