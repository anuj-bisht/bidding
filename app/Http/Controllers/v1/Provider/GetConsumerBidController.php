<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class GetConsumerBidController extends Controller
{
    public function consignmentList(Request $request)
    {
         $user=JWTAuth::user();
        // $data=DB::table('providers')->where('user_id', $user->id)
        //        ->get();
        $category = $request->category_id;
        $bids_applied = DB::table('applybids')->where('provider_id', $user->id)->select('userbids_id')->get()->pluck('userbids_id');
        switch ($category) {
            case('1'):
                $data = DB::table('userbids')
                    ->where('userbids.category_id', $category)
                    ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                    ->whereNotIn('userbids.id', $bids_applied)
                    ->where('userbids.status', 'pending')
                    ->whereDate('usertours.date_of_travel','<=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereDate('usertours.end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->select('userbids.id as userbid_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.ETA', 'userbids.distance', 'userbids.status', 'categories.category', 'usertours.description', 'users.name as username', 'usertours.order_id', 'users.mobile as user_mobile', 'users.email as user_email',
                        'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.number_of_passenger', 'vehicles.name')
                    ->orderBy('usertours.date_of_travel')->get();
                $msg = "Tour And Travel Consignment List";
                break;

            case('2'):
                $data = DB::table('userbids')
                    ->where('userbids.category_id', $category)
                    ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                    ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                    ->whereNotIn('userbids.id', $bids_applied)
                    ->where('userbids.status', 'pending')
                    ->whereDate('usertransports.shifting_date','<=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereDate('usertransports.end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->select('userbids.id as userbid_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.ETA', 'userbids.distance', 'userbids.status', 'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'categories.category',
                        'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name')
                    ->orderBy('usertransports.shifting_date')->get();
                $msg = "Transport Consignment List";
                break;
            case('3'):
                $data = DB::table('userbids')
                    ->where('userbids.category_id', $category)
                    ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                    ->join('flats', 'flats.id', 'userpackages.flat_type')
                    ->whereNotIn('userbids.id', $bids_applied)
                    ->where('userbids.status', 'pending')
                    ->whereDate('userpackages.date_of_shifting','<=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereDate('userpackages.end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'))
                    ->select('userbids.id as userbid_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.ETA', 'userbids.distance', 'userbids.status', 'userpackages.description', 'userpackages.order_id', 'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.images as flat_images', 'flats.flat_type', 'categories.category',
                        'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'vehicles.name as vehicle_name')
                    ->orderBy('userpackages.date_of_shifting')->get();
                $msg = "Package&Movers Consignment List";
                break;
        }

        if (count($data) > 0) {
            return response()->json(['status' => 1, 'message' => $msg, 'data' => $data]);
        } else {
            return response()->json(['status' => 0, 'message' => 'no Consignment List', 'data' => []]);
        }
    }

    public function viewConsignment(Request $request)
    {
        $user = JWTAuth::user();
        if (isset($user)) {
            $consignment_id = $request->consignment_id;
            $data = DB::table('userbids')->where('id', $consignment_id)->first();
            if (isset($data)) {
                $category_id = $data->category_id;
                switch ($category_id) {
                    case('1'):
                        $data = DB::table('userbids')
                            ->where('userbids.id', $consignment_id)
                            ->where('userbids.category_id', $category_id)
                            ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                            ->join('categories', 'categories.id', 'userbids.category_id')
                            ->join('users', 'users.id', 'userbids.user_id')
                            ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                            ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                                'userbids.distance', 'userbids.status', 'categories.category', 'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email',
                                'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'categories.id as category_id', 'categories.category', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')
                            ->first();
                        $msg = "Tour And Travel Consignment ";
                        break;

                    case('2'):
                        $data = DB::table('userbids')
                            ->where('userbids.id', $consignment_id)
                            ->where('userbids.category_id', $category_id)
                            ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                            ->join('categories', 'categories.id', 'userbids.category_id')
                            ->join('users', 'users.id', 'userbids.user_id')
                            ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                            ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                            ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                                'userbids.distance', 'userbids.status', 'usertransports.description', 'usertransports.order_id', 'usertransports.vehicle_bodytype', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'categories.id as category_id', 'categories.category',
                                'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')
                            ->first();
                        $msg = "Transport Consignment ";
                        break;
                    case('3'):
                        $data = DB::table('userbids')
                            ->where('userbids.id', $consignment_id)
                            ->where('userbids.category_id', $category_id)
                            ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                            ->join('categories', 'categories.id', 'userbids.category_id')
                            ->join('users', 'users.id', 'userbids.user_id')
                            ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                            ->join('flats', 'flats.id', 'userpackages.flat_type')
                            ->select('userbids.id as userbid_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                                'userbids.distance', 'userbids.status', 'userpackages.description', 'userpackages.order_id', 'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.images as flat_images', 'flats.flat_type', 'categories.id as category_id', 'categories.category',
                                'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')->first();
                        $msg = "Package&Movers Consignment List";
                        break;
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'No Consignment Found', 'data' => []]);

            }

            if (isset($data)) {
                return response()->json(['status' => 1, 'message' => $msg, 'data' => $data]);
            } else {
                return response()->json(['status' => 0, 'message' => 'No Consignment Found', 'data' => []]);
            }
        }

        // }else{
        //     return response()->json(['status'=>0, 'message'=>'No Data Found', 'data'=>[]]);
        // }
        else {
            return response()->json(['status' => 0, 'message' => 'User Not Found', 'data' => []]);
        }

    }
}

