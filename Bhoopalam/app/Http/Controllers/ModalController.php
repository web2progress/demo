<?php

namespace App\Http\Controllers;

use App\Models\Modal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modals = Modal::Paginate(8);
        return view('admin.blog.modals.index', compact('modals'));
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
            'title' => 'required'
        ]);
     if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $modelCreate = Modal::create([
                'title' => $request->title,
            ]);
            if ($modelCreate) {
                return redirect('admin/blog-modals/' . $modelCreate->id . '/edit');
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
        $editmodal = Modal::findOrFail($id);
        return view('admin.blog.modals.edit', compact('editmodal'));
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

        $publishUpdate = Modal::where('id', $id)->update([
            'title' => $request->title,
            'status' => $request->status,
            'content' => $request->content
        ]);

        if (!empty($request->content)) {
            if ($publishUpdate) {
                if ($request->status == 'publish') {
                    return response()->json(['msg' => 'Post Published', 'status' => true]);
                } else {
                    return response()->json(['msg' => 'Post move in Draft', 'status' => false]);
                }
            } else {
                return response()->json(['msg' => 'Something went wrong', 'status' => false]);
            }
        } else {
            return response()->json(['msg' => 'write something', 'status' => false]);
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

        $data = Modal::where('id', $id)->delete();
        if ($data) {
            return response()->json(['msg' => 'Modal Successfully Deleted', 'status' => true]);
        } else {
            return response()->json(['msg' => 'something Went wrong', 'status' => false]);
        }
    }
}
