<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreEnquiry;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class MailController extends Controller
{
  //
  function bookNow(Request $request)
  {

   // return $request->all();
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'number' => 'required|digits_between:9,13',
      ]);
    //Check for validation
    if ($validator->fails()) {
      //return Redirect::back()->withErrors($validator)->withInput();
       return response()->json(['msg'=>'all fields are required','status'=>false]);
    } else {
        $catCreate = new StoreEnquiry();
        $catCreate->name = $request->name;
        $catCreate->email = $request->email;
        $catCreate->phone = $request->number;
        $catCreate->subject = $request->subject;
        $catCreate->message = $request->message;

      if ($catCreate->save()) {

          Mail::send(
              'mail.booking',
              array(
                  'name' => $request->get('name'),
                  'number' => $request->get('number'),
                  'email' => $request->get('email'),
                  'subject' => $request->get('subject'),
                  'msg' => $request->get('message'),
              ),
              function ($message) use ($request) {
                  $emails = array('info@pvrindustries.com');
                  $message->from('info@pvrindustries.com');
                  $message->to($emails)->subject($request->name.' - Mail From PVR-fabrication booking Pages');
              }
          );
          return response()->json(['msg'=>'Mai Send Successfully','status'=>true]);
      }
    }
  }



  //
  function SendEnquiry(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required',
      'number' => 'required',
      'message' => 'required',
    ]);
    //Check for validation
    if ($validator->fails()) {
      return Redirect::back()->withErrors($validator)->withInput();
      // return redirect('/category')->withErrors($validator);
    } else {



      $catCreate = new StoreEnquiry();
      $catCreate->name = $request->name;
      $catCreate->email = $request->email;
      $catCreate->phone = $request->number;
      $catCreate->message = $request->message;

      if ($catCreate->save()) {
        Mail::send(
            'mail.enquiry',
            array(
                'name' => $request->get('name'),
                'number' => $request->get('number'),
                'email' => $request->get('email'),
                'msg' => $request->get('message'),
            ),
            function ($message) use ($request) {
                $emails = array('vimalsharma0753@gmail.com','kamnipatel6702@gmail.com');
                $message->from('vimalsharma0753@gmail.com');
                $message->to($emails)->subject($request->name.' - Mail From Bhoopalam booking Pages');
            }
        );
        return view('mail.enquiry-alert', ['name' =>  $request->get('name')]);
      }
    }
  }
}
