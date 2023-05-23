<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\HotelImagesGallery;
use App\Models\Location;
use App\Models\MealPlan;
use App\Models\MealPlanHotel;
use App\Models\Place;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotels.index');
    }

    // search hotel
    public function searchHotel(Request $request)
    {
        /* Process ajax request */

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Hotel::where('status', 'publish')->orWhere('status', 'draft')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = Hotel::where('status', 'publish')->orWhere('status', 'draft')->select('count(*) as allcount')->where('title', 'like', '%' . $searchValue . '%')->count();

        // Get records, also we have included search filter as well
        $records = Hotel::where('status', 'publish')->orWhere('status', 'draft')->orderBy($columnName, $columnSortOrder)
            ->Where('hotels.title', 'like', '%' . $searchValue . '%')
            ->orWhere('hotels.places', 'like', '%' . $searchValue . '%')
            ->orWhere('hotels.facilities', 'like', '%' . $searchValue . '%')
            ->select('hotels.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            if ($record->status == 'publish' || $record->status == 'draft') {

                if (empty($record->seo_keyword)) {
                    $keyword = '<div contenteditable="true" class="update bg-light" data-id="' . $record->id . '" data-column="seo_keyword">' . $record->seo_keyword . '</div>';
                } else {
                    $keyword = '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="seo_keyword">' . $record->seo_keyword . '</div>';
                }
                // desc
                if (empty($record->seo_description)) {
                    $description = '<div contenteditable="true" class="update bg-light" data-id="' . $record->id . '" data-column="description">' . $record->seo_description . '</div>';
                } else {
                    $description = '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="seo_description">' . $record->seo_description . '</div>';
                }





                $data_arr[] = array(
                    "id" => $record->id,

                    "title" => '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="title">' . $record->title . '</div>',

                    "slug" => '<div contenteditable="true" class="update" data-id="' . $record->id . '" data-column="slug">' . $record->slug . '</div>',

                    "keyword" => $keyword,

                    "description" => $description,

                    "view" => $record->view,
                    "status" => $record->status,
                    "created_at" => $record->created_at->format('d-M-Y'),
                    "action" => '<div class="d-flex justify-content-center">
                 <a href="/admin/hotels/' . $record->id . '/edit" class="btn btn-sm btn-info text-light"><i class="lni lni-pencil"></i></a>
                     <button type="button" class="btn btn-sm btn-danger text-light delete" id="' . $record->id . '" data-uri="/admin/hotels/' . $record->id . '"><i class="lni lni-trash"></i>
                     </button>
             </div>',
                );
            }
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:hotels,title',
            'slug' => 'required|unique:hotels,slug'
        ]);
        //Check for validation
        if ($validator->fails()) {

            // $messages = $request->messages(); // get the error message.


            return Redirect::back()->withErrors($validator)->withInput();
            // return redirect('/location')->withErrors($validator);
        } else {
            //do your actual operation here.
            $createPost = new Hotel();
            $input = $request->all();
            $createPost->title = $request->title;
            $createPost->slug = $request->slug;
            $createPost->user_id = Auth()->user()->id;
            $createPost->status = 'draft';
            if ($createPost->save()) {
                // default rating
                $Posts = Rating::create([
                    'hotel_id' => $createPost->id
                ]);
                // get post
                $Posts = Hotel::where('slug', $request->slug)->first();

                return redirect('admin/hotels/' . $Posts->id . '/edit')->with('success', 'Url  successfully created!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $hotels = Hotel::where('id', $id)->first();
        $locations = Location::where('status', 'active')->get();
        $places = Place::where('status', 'active')->get();
        $mealPlans = MealPlan::where('status', 'active')->get();
        $facilities = Facility::where('status', 'active')->get();

        return view('admin.hotels.edit', compact('hotels', 'locations', 'places', 'mealPlans', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $table = Hotel::where('id', $id)->first();
        if ($request->column_title =='mrp_price') {
            // mrp_price
            $table->price = $request->value - (($request->value * $table->offer_price) / 100);
            $table->mrp_price = $request->value;
        } else if ($request->column_title =='offer_price') {
            // mrp_price
            $table->price = $table->mrp_price - (($table->mrp_price * $request->value) / 100);
            $table->offer_price = $request->value;
        } else {
            $table->{$request->column_title} = $request->value;
        }

        $table->update();
        return ('Udated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Hotel::where('id', $id)->delete();
        if ($delete) {
            return response()->json(['msg' => 'Hotel deleted', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }


    //PostLocation
    function PostLocation(Request $request)
    {
        // array implode
        $locationData = $request->location_id;
        $update = Hotel::where('id', $request->id)->update([
            'location' => $locationData
        ]);
        if ($update) {
            return ('Update Success');
        }
    }

    //PostMultiPlaces
    function PostMultiPlaces(Request $request)
    {
        // array implode
        $placeData = implode(', ', $request->place_id);
        $update = Hotel::where('id', $request->id)->update([
            'places' => $placeData
        ]);
        if ($update) {
            return ('Update Success');
        }
    }
    //PostMultiFacilities
    function PostMultiFacilities(Request $request)
    {
        // array implode
        $facilityData = implode(', ', $request->facility_id);
        $update = Hotel::where('id', $request->id)->update([
            'facilities' => $facilityData
        ]);
        if ($update) {
            return ('Update Success');
        }
    }

    //PostMultiMealplans
    function MealPlanAdd(Request $request)
    {

        // return dd($request->all());
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'mealplan_id' => 'required',
            'meal_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'all fields are required', 'status' => false]);
        } else {
            $check = MealPlanHotel::where(['hotel_id' => $request->hotel_id, 'mealplan_id' => $request->mealplan_id])->count();
            if ($check > 0) {
                return response()->json(['msg' => 'Meal Plan Already Exist', 'status' => false]);
            } else {
                $update = MealPlanHotel::create([
                    'hotel_id' => $request->hotel_id,
                    'mealplan_id' => $request->mealplan_id,
                    'meal_price' => $request->meal_price,
                ]);
                if ($update) {
                    return response()->json(['msg' => 'Meal Paln successfully added', 'status' => true]);
                }
            }
        }
    }
    // loadDataMealPaln
    function loadDataMealPaln(Request $request)
    {
        // array implode
        $mPlanHotels = MealPlanHotel::where('hotel_id', $request->id)->get();
        return view('admin.hotels._meal-plans', compact('mPlanHotels'));
    }

    // delmelas Hotel
    function delmelasHotel(Request $request)
    {
        $delete = MealPlanHotel::where('id', $request->id)->delete();
        if ($delete) {
            return response()->json(['msg' => 'Meal Paln successfully deleted', 'status' => true]);
        }
    }




    //rePublishHotel
    function rePublishHotel(Request $req)
    {
        //dd($req->all());
        $publishUpdate = Hotel::where('id', $req->id)->update([
            'status' => $req->status,
            'description' => $req->content
        ]);
        if ($publishUpdate) {
            if ($req->status == 'publish') {
                return response()->json(['msg' => 'Hotel Published', 'status' => true]);
            } else {
                return response()->json(['msg' => 'Hotel move in Draft', 'status' => false]);
            }
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }
    // upload images
    public function imageGallery(Request $request)
    {
        //return dd($request->all());
        $data = new HotelImagesGallery();
        $id = $request->id;
        foreach (explode(',', $request->images) as $img) {
            $data->create([
                'hotel_id' => $id,
                'image' => $img,
            ]);
        }
        if ($data) {
            return response()->json(['msg' => 'Gallery successfully updated', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }
    //loadGallery
    function loadGallery(Request $request)
    {
        // array implode
        $gallery = HotelImagesGallery::where('hotel_id', $request->id)->get();
        return view('admin.hotels._hotel-galery', compact('gallery'));
    }
    //delGalleyImage
    function delGalleyImage(Request $request)
    {
        $delete = HotelImagesGallery::where('id', $request->id)->delete();
        if ($delete) {
            return response()->json(['msg' => 'Galley image deleted', 'status' => true]);
        } else {
            return response()->json(['msg' => 'Something went wrong', 'status' => false]);
        }
    }
}
