<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.header-manage.manage-slider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slider = Slider::orderBy('id', 'DESC')->get();
        return view('admin.header-manage.fetchSlider', ['slider' => $slider]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = 'images/slider/';
        $request->validate([
            'img.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasfile('img')) {
            $img = $request->file('img');


            foreach ($img as $image) {
                $name = rand(1000000, 999999999) . '.' . $image->extension();
                $image->move(public_path($path), $name);
                Slider::create([
                    'image' => $name, 'position' => '0',
                ]);
            }
        }

        return ('Slider uploaded successfully');
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
    public function destroy(Request $req)
    {
        $path = 'images/slider/';
        $table = Slider::where('id', $req->id)->first();
        File::delete(public_path($path . '/' . $table->image));

        $table = Slider::where('id', $req->id);
        $table->delete();
        return ('Your imaginary Slider has been deleted');
    }


    // activeSlide
    public function activeSlide(Request $req)
    {

        if (Slider::query()->update(['position' => 0])) {
            $table = Slider::where('id', $req->id)->first();
            $table->position = '1';
            if ($table->update()) {
                return ('First Slide Activated');
            }
        }
    }
    public function silderTextUpdate(Request $request)
    {
        $update = Slider::where('id',$request->id);
        $update->update([
            $request->column => $request->value
        ]);
        if ($update) {
            return response()->json(['msg' => 'Updated', 'status' => true]);
        } else {
            return response()->json(['msg' => 'semething went wrong', 'status' => false]);
        }
    }
}
