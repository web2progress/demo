<?php

namespace App\Http\Controllers;

use App\Models\indianAllPincode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function uploadCropImage(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $image = $request->image;

        list($type, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);
        $image = base64_decode($image);
        if (!empty($user->img)) {
            $image_name = $user->img;
        } else {
            $image_name = time() . '.png';
        }

        $path = public_path('images/profile/' . $image_name);

        file_put_contents($path, $image);

        $user->update(['img' => $image_name]);
        if ($user) {
            return response()->json(['msg' => 'Profile successfully uploaded', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }

    public function getAddress(Request $request)
    {
        if (strlen($request->key) > 2) {
            $address = indianAllPincode::where('Pincode', 'LIKE', "%$request->key%")
                ->orWhere('City', 'LIKE', "%$request->key%")
                ->orWhere('District', 'LIKE', "%$request->key%")
                ->orWhere('State', 'LIKE', "%$request->key%")
                ->take(8)->get();

            if ($address->count() != 0) {
                $data = '';
                foreach ($address as $add) {
                    $data .= '<span class="add-address" data-id="' . $add->id . '" data-attr="' . $add->Pincode . '-' . $add->City . '-' . $add->District . '-' . $add->State . '">' . $add->Pincode . '-' . $add->City . '-' . $add->District . '-' . $add->State . '</span>';
                }
                return response()->json(['data' => $data, 'status' => true]);
            } else {
                return response()->json(['data' => '', 'status' => false]);
            }
        } else {
            return response()->json(['data' => '', 'status' => false]);
        }
    }

    public function updateProfileDetails(Request $request)
    {
        $user = User::where('id', '!=', auth()->user()->id)->where('email', $request->email)->count();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mo_number' => 'required',
            'address' => 'required',
            'address_id' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['msg' => 'All fields are required', 'status' => false]);
            // return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);


        } else {
            if ($user > 0) {
                // user with that email already exists
                return response()->json(['msg' => 'user with that email already exists', 'status' => false]);
            } else {
                $updateProfile = User::where('id', auth()->user()->id)->update([
                    'name' => $request->name,
                    'mo_number' => $request->mo_number,
                    'email' => $request->email,
                    'address' => $request->address,
                    'address_id' => $request->address_id,
                ]);
                if ($updateProfile) {
                    return response()->json(['msg' => 'profile updated successfully', 'status' => true]);
                } else {
                    return response()->json(['msg' => 'All fields are required', 'status' => false]);
                }
            }
        }
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
}
