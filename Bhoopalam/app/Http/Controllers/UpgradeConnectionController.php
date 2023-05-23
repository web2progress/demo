<?php

namespace App\Http\Controllers;

use App\Models\ConnectionApply;
use App\Models\ConnectionUpgrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpgradeConnectionController extends Controller
{


    public function upgradePlan(Request $request)
    {
        $user = ConnectionUpgrade::where('user_id', auth()->user()->id)->where('status','pending')->count();
        if ($user > 0) { 
            return redirect()->back();
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'mobileNumber' => 'required',
                'altMobileNumber' => 'required',
                'companyname' => 'required',
                'address' => 'required',
                'request_doc' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
                'application' => 'required|image|mimes:jpeg,jpg,png,jpg|max:5048',
            ]);
            if ($validator->fails()) {
                return response()->json(['msg' => $validator, 'status' => false]);
            } else {

                $apply_id =  time();
                $request_doc = time() . rand(111, 999) . '.' . $request->request_doc->extension();
                $application = time() . rand(111, 9999) . '.' . $request->application->extension();

                // rezize imamge
                $filePath = public_path('images/docs/');
                // Store product original images
                $request->request_doc->move($filePath, $request_doc);
                $request->application->move($filePath, $application);

                //insert data
                $connection = new ConnectionUpgrade();
                $connection->application_id = $apply_id;
                $connection->user_id = auth()->user()->id;
                $connection->fullname = $request->fullname;
                $connection->address = $request->address;
                $connection->companyname = $request->companyname;
                $connection->mobileNumber = $request->mobileNumber;
                $connection->altMobileNumber = $request->altMobileNumber;
                $connection->request_doc = $request_doc;
                $connection->application = $application;

                $connection->save();
                if ($connection->save()) {
                    return view('user.success', ['application_id' => $apply_id]);
                }
            }
        }
    }
}
