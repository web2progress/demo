<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Redirect; 
class BookingDetailController extends Controller
{
 
    function bookingDtails()
    {
        $booking = BookingDetail::orderby('id', 'desc')->paginate(10);
        return view('admin.booking-details', ['bookings' => $booking]);
    }

    // deleteDetails 
    public function deleteBookingDetails(Request $req)
    {
        $table = BookingDetail::where('id', $req->id);
        $table->delete();
        return ('Your Booking Details has been deleted');
    }

    function updateBookinStatus(Request $req){
        $table = BookingDetail::where('id', $req->id)->first();
        $table->{$req->column_title} = $req->value;
        $table->update();
        return ('Data Changed');
    }
}
