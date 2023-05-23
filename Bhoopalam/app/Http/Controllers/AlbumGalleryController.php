<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Models\Album;
use App\Models\Gallery;

class AlbumGalleryController extends Controller
{
    //
    //
    function addImages($id)
    {
        $album = Album::where('id', $id)->first();
        $galleries = Gallery::where('album_id', $id)->get();

        return view('admin.add-images', ['albums' => $album, 'galleries' => $galleries]);
    }

    function fetchGallery(Request $request)
    {
        $galleries = Gallery::where('album_id', $request->id)->orderBy('id', 'DESC')->get();

        return view('admin.fetchGallery', ['galleries' => $galleries]);
    }

    // upload img
    public function ImageUpload(Request $request)
    {

        $path = 'images/gallery/';
        $validator = $request->validate([
            'id' => 'required',
            'filedata.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!$validator) {

        } else {
            if ($request->hasfile('filedata')) {
                $img = $request->file('filedata');
                $name = rand(1000000, 999999999) . '.' . $img->extension();
                $img->move(public_path($path), $name);

                $insert = Gallery::create([
                    'album_id' => $request->id,
                    'imag_title' => $name
                ]);
                if ($insert) {
                  return response()->json(['msg' => 'Upload success!', 'status'=>true]);
                }
            }
        }
    }
    // deleteCat
    public function deleteGallery(Request $req)
    {
        $path = 'images/gallery/';
        $table = Gallery::where('id', $req->id)->first();
        File::delete(public_path($path . '/' . $table->imag_title));


        $table = Gallery::where('id', $req->id);
        $table->delete();
        return ('Your imaginary album has been deleted');
    }

    //  manage gallery
    function manageGallery()
    {
        $album = Album::paginate(5);
        return view('admin.manage-gallery', ['albums' => $album]);
    }


    // HOMePAGE GALLERY
    function gallery()
    {
        $album = Album::get();

        return view('frontend.gallery', ['albums' => $album]);
    }

    function viewGallery($url)
    {
        $album = Album::where('album_slug', $url)->first();
        $galleries = Gallery::where('album_id', $album->id)->get();

        return view('frontend.view-gallery', ['albums' => $album, 'galleries' => $galleries]);
    }

}
