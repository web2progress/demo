<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use App\Models\StoreEnquiry;
use Illuminate\Support\Facades\Redirect;
class StoreEnquiryController extends Controller
{
  
    function enquiryDtails()
    {
        $enquiry = StoreEnquiry::orderby('id', 'desc')->paginate(10);
        return view('admin.enquiry-details', ['enquiry' => $enquiry]);
    }

    // deleteDetails 
    public function deleteDetails(Request $req)
    {
        $table = StoreEnquiry::where('id', $req->id);
        $table->delete();
        return ('Your Booking Details has been deleted');
    }

    function Delete(Request $request, $id){
        StoreEnquiry::where('id', $id)->delete();
        return('done');
        }
}
