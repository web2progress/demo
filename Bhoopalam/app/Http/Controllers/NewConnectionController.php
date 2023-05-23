<?php

namespace App\Http\Controllers;

use App\Models\ConnectionApply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewConnectionController extends Controller
{
    public function newConnection(Request $request)
    { 
        $user = ConnectionApply::where('user_id', auth()->user()->id)->where('status', 'pending')->count();
        if ($user > 0) {
            return redirect()->back();
        } else {


            $validator = Validator::make($request->all(), [
                'fullname' => 'required|min:2',
                'address' => 'required',
                'email' => 'required|email',
                'mobileNumber' => 'required|min:10',
                'altMobileNumber' => 'required|min:10',
                'pincode' => 'required|max:8',
                'area' => 'required',
                'companyname' => 'required',
                'extention' => 'required',
                'doorNoAndstreet' => 'required',
                'rentalDocument' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
                'panCard' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
                'adharCard' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
                'companyRegistrationDoc' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
            ]);
            if ($validator->fails()) {
                return response()->json(['msg' => $validator, 'status' => false]);
            } else {

                $appid =  time();
                $rentalDocument = time() . rand(111, 999) . '.' . $request->rentalDocument->extension();
                $panCard = time() . rand(111, 9999) . '.' . $request->panCard->extension();
                $adharCard = time() . rand(111, 99999) . '.' . $request->adharCard->extension();
                $companyRegistrationDoc = time() . rand(111, 999999) . '.' . $request->companyRegistrationDoc->extension();
                // rezize imamge
                $filePath = public_path('images/docs/');
                // Store product original images
                $request->rentalDocument->move($filePath, $rentalDocument);
                $request->panCard->move($filePath, $panCard);
                $request->adharCard->move($filePath, $adharCard);
                $request->companyRegistrationDoc->move($filePath, $companyRegistrationDoc);
                //insert data
                $connection = new ConnectionApply();
                $connection->application_id = $appid;
                $connection->user_id = auth()->user()->id;
                $connection->fullname = $request->fullname;
                $connection->address = $request->address;
                $connection->email = $request->email;
                $connection->mobileNumber = $request->mobileNumber;
                $connection->altMobileNumber = $request->altMobileNumber;
                $connection->pincode = $request->pincode;
                $connection->area = $request->area;
                $connection->companyname = $request->companyname;
                $connection->extention = $request->extention;
                $connection->doorNoAndstreet = $request->doorNoAndstreet;
                $connection->rentalDocument = $rentalDocument;
                $connection->panCard = $panCard;
                $connection->adharCard = $adharCard;
                $connection->companyRegistrationDoc = $companyRegistrationDoc;
                $connection->save();
                if ($connection->save()) {
                    return view('user.success', ['application_id' => $appid]);
                }
            }
        }
    }
}
