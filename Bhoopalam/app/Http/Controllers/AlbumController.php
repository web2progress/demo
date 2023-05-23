<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Album;
class AlbumController extends Controller
{
    //
    function album()
    {
        $album = Album::orderBy('id', 'DESC')->paginate(6);
        return view('admin.create-album', ['albums' => $album]);
    }

    // add actegory
    public function addalbum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'album_title' => 'required|unique:albums,album_title',
            'album_slug' => 'required|unique:albums,album_slug',
        ]);
        //Check for validation
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            //do your actual operation here.
            $catCreate = new album();
            $catCreate->album_title = $request->album_title;
            $catCreate->album_slug = $request->album_slug;
            $catCreate->save();

            return redirect('/admin/create-album')->with('success', 'album  successfully created!');
        }
    }

    // deleteCat
    public function deleteAlbum(Request $req)
    {
        $table = Album::where('id', $req->id);
        $table->delete();
        return ('Your imaginary album has been deleted');
    }

    function updatealbum(Request $req)
    {
        $table = Album::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Data Changed');
        //  return  with('success', 'country has been updated');
    }
}


