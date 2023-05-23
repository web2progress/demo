<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MediaIcon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 

class MediaIconController extends Controller
{
  //
  public function index()
  {
    $media = MediaIcon::first();
    return view('admin.header-manage.media-&-icons', ['media' => $media]);
  }

  // activeIcon
  function activeIcon(Request $request)
  {
    $insertMedia = new MediaIcon();
    $insertMedia->id = '1';
    $insertMedia->save();
    return redirect('/dashboard/media-&-icons');
  }   
  
  
  // updateIcon
  function updateIcon(Request $request)
  {
    $media = MediaIcon::where('id', $request->id)->first();
    $media->{$request->column_title} = $request->value;
    $media->update();
    return ('Udated');
  }
  
  
  // uloadLogo
  function uloadLogo(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);
  $input = $request->all();
  // Product images folder
  $path = 'assets/images/logo/';

  if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
  } else {
      $table = MediaIcon::where('id', '1')->first();
      if (!empty($table->logo)) {
          //File::delete(public_path($path . '/' . $table->logo));
          $logo = pathinfo($table->logo, PATHINFO_FILENAME) . '.' . $request->logo->extension();
      } else {
          $logo = time() . '.' . $request->logo->extension();
      }
  
      // Store product original images
      $request->logo->move(public_path($path), $logo);
      $table->logo = $logo;
      $table->update();
      return response('done');
  }
  }
}
