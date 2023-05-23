<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function index (Request $request){


        return view('admin.plans.index');
    }


    public function store(Request $request){



            $Plan = new Plans();
            $Plan->parameters = $request->parameters;
            $Plan->plan_id = $request->plan_id;
            $Plan->plan_name = $request->plan_name;
            $Plan->speed = $request->speed;
            $Plan->fup = $request->fup;
            $Plan->beyound_fup = $request->beyound_fup;
            $Plan->applicability = $request->applicability;
            $Plan->security_fees = $request->security_fees;
            $Plan->minimum_period = $request->minimum_period;
            $Plan->free_calls = $request->free_calls;
            $Plan->additional = $request->additional;
            $Plan->remarks = $request->description;
            $Plan->amount = $request->amount;
            $Plan->amount3 = $request->amount3;
            $Plan->amount6 = $request->amount6;
            $Plan->amount12 = $request->amount12;

            if($Plan->save()){
                return response()->json(['msg' => 'Data Saved Successfully.', 'status' => true]);

            }else{
                return response()->json(['msg' => 'Problem to save the data.', 'status' => true]);

            }
    }


    public function plansview (Request $request,$id){

    $plan=    Plans::where('id',$id)->first();
    $plan=    Plans::where('id',$id)->first();

    return view('frontend.planview',['plan'=>$plan]);
    }


    public function updatePlan(Request $request){

        $Plan = Plans::where('id', $request->id)->first();


        $Plan->parameters = $request->parameters;
        $Plan->plan_id = $request->plan_id;
        $Plan->plan_name = $request->plan_name;
        $Plan->speed = $request->speed;
        $Plan->fup = $request->fup;
        $Plan->beyound_fup = $request->beyound_fup;
        $Plan->applicability = $request->applicability;
        $Plan->security_fees = $request->security_fees;
        $Plan->minimum_period = $request->minimum_period;
        $Plan->free_calls = $request->free_calls;
        $Plan->additional = $request->additional;
        $Plan->remarks = $request->description;
        $Plan->amount = $request->amount;
        $Plan->amount3 = $request->amount3;
        $Plan->amount6 = $request->amount6;
        $Plan->amount12 = $request->amount12;
        $Plan->update();
        return  redirect ('admin/plans');
    }

    public function Delete(Request $request,$id){

        $Plan = Plans::where('id', $request->id)->delete();
        return('updated');
    }
}
