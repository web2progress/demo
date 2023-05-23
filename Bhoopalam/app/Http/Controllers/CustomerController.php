<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
   public function saveCustomer(  Request $request){

    $validator = Validator::make($request->all(), [
        'aadhar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'pan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ]);

    $path = '/storage/files/customers';


    $filename1 = time().'.'.request()->aadhar->getClientOriginalExtension();
    request()->aadhar->move(public_path($path), $filename1);

    $filename2 = time().'.'.request()->pan->getClientOriginalExtension();
    request()->pan->move(public_path($path), $filename2);


    $customer = new Customer();
    $customer->aadhar=$filename1;
    $customer->pan=$filename2;
    $customer->name= $request->name;
    $customer->email= $request->email;
    $customer->phone= $request->mobile;
    $customer->remarks= $request->remark;
    $customer->plan_name= $request->planname;
    $customer->save();


    return('data saved successfully');
   }

   public function login(Request $request){
    return view('frontend/userlogin');
   }

   public function loginverify(Request $request){
    $number= $request->mobile;
   $data= Customer::where('phone',$number)->first();
   if($data==null){
    return('This is not a valid phone number ');
   }
   return view('frontend/userview',['customer'=>$data]);
   }



   function updateCustomer(Request $req)
    {
        $table = Customer::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Udated');
        //  return  with('success', 'country has been updated');
    }

    function ImageUpload(Request $request){
        $path = '/storage/files/customers';



        if($request->exists('pan')){
        $filename1 = time().'.'.request()->pan->getClientOriginalExtension();
        request()->pan->move(public_path($path), $filename1);

        $table = Customer::where('id', $request->id)->first();
        $table->pan=$filename1;
        $table->update();

        }else{

            $filename2 = time().'.'.request()->aadhar->getClientOriginalExtension();
        request()->aadhar->move(public_path($path), $filename2);

        $table = Customer::where('id', $request->id)->first();
        $table->aadhar=$filename2;
        $table->update();
        }

return('updated');
    }




    function profileUpload(Request $request){


        $path = '/storage/files/customers/profile';


        $profile = time().'.'.request()->profile->getClientOriginalExtension();
        request()->profile->move(public_path($path), $profile);

        $table = Customer::where('id', $request->id)->first();
        $table->profile=$profile;
        $table->update();

   return ('update');

}


function NumberCheck(Request $request, $id){


    $number= Customer::where('phone', $id)->count();
    if($number>0){
    return response()->json(['msg' => 'success']);
    }else{
        return response()->json(['msg' => 'not']);
    }
}

function profiledata(Request $request, $id){
    $customer= Customer::where('id', $id)->first();

    return view('admin/customerprofile', ['customer'=>$customer]);
}



}
