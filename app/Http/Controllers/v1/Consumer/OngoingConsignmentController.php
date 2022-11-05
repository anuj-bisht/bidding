<?php

namespace App\Http\Controllers\v1\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Provider;

class OngoingConsignmentController extends Controller
{
    public function consumerOngoinConsignment()
    {
        $user = JWTAuth::user();
        $data = DB::table('userbids')->where('user_id', $user->id)->where('userbids.status', '!=', 'complete')->where('userbids.status', '!=', 'pending')
            ->orWhere('userbids.status', 'Inprogress')->get();
        if (count($data) > 0) {
            foreach ($data as $ongoingConsignment) {
                $datas = [];
                $tr = [];
                $pc = [];
                //   switch($user_category->category_id){
                if ($ongoingConsignment->category_id == '2') {

                    $bid = DB::table('userbids')
//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', function($query){
                            $query->on('applybids.userbids_id', 'userbids.id')
                                    ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)');
                        })
                        //-- End Sayed Code --//
                        ->join('providers', 'providers.user_id', 'applybids.provider_id')
                        ->where('userbids.user_id', $user->id)
                        ->where('userbids.category_id', 2)
                        ->where('userbids.status', '!=', 'complete')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance', 'userbids.ETA', 'userbids.status as consignment_status', 'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'categories.category', 'categories.icon',
                            'users.name as username', 'users.mobile as usermobile', 'users.email as useremail', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon', 'applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email')
                        ->get();


                }
                elseif ($ongoingConsignment->category_id == '1') {
                    $bids = DB::table('userbids')
//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', function($query){
                            $query->on('applybids.userbids_id', 'userbids.id')
                                ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)');
                        })
                        //-- End Sayed Code --//
                        ->join('providers', 'providers.user_id', 'applybids.provider_id')
                        ->where('userbids.user_id', $user->id)
                        ->where('userbids.category_id', 1)
                        ->where('userbids.status', '!=', 'complete')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance', 'userbids.ETA', 'userbids.status as consignment_status', 'categories.category', 'categories.icon', 'users.name as username', 'users.mobile as usermobile', 'users.email as useremail',
                            'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name', 'vehicles.vehicle_icon as vehicle_icon', 'applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email')

                        ->get();


                }
                elseif ($ongoingConsignment->category_id == '3') {
                    $bidss = DB::table('userbids')->where('userbids.user_id', $user->id)

//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                        ->join('flats', 'flats.id', 'userpackages.flat_type')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', function($query){
                            $query->on('applybids.userbids_id', 'userbids.id')
                                ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)');
                        })
                        //-- End Sayed Code --//
                        ->join('providers', 'providers.user_id', 'applybids.provider_id')
                        ->where('userbids.category_id', 3)
                        ->where('userbids.status', '!=', 'complete')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance', 'userbids.status as consignment_status', 'userbids.ETA', 'categories.category', 'categories.icon', 'users.name as username', 'users.mobile as usermobile', 'users.email as useremail',
                            'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description', 'userpackages.images', 'userpackages.order_id', 'flats.flat_type', 'vehicles.name', 'vehicles.vehicle_icon as vehicle_icon', 'applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email')
                        ->get();


                }


            }
            if (isset($bid) && isset($bids) && isset($bidss)) {
                $array = array_merge($bid->toArray(), $bids->toArray(), $bidss->toArray());
            } elseif (isset($bid) && isset($bids)) {
                $array = array_merge($bid->toArray(), $bids->toArray());
            } elseif (isset($bid) && isset($bidss)) {
                $array = array_merge($bid->toArray(), $bidss->toArray());
            } elseif (isset($bids) && isset($bidss)) {
                $array = array_merge($bids->toArray(), $bidss->toArray());

            } elseif (isset($bid)) {
                $array = $bid;
            } elseif (isset($bids)) {
                $array = $bids;
            } elseif (isset($bidss)) {
                $array = $bidss;
            }
            return response()->json(['status' => 1, 'message' => 'Ongoing Consignment List', 'data' => $array]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No Ongoing Consignment Found', 'data' => []]);

        }
    }

    public function viewOngoing(Request $request)
    {
        $dat = DB::table('applybids')->where('applybids.id', $request->bid_id)->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')->first();


        if ($dat->category_id == '2') {
            $data = DB::table('applybids')
                ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                ->join('providers', 'providers.user_id', 'applybids.provider_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('categories', 'categories.id', 'userbids.category_id')
                ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                ->where('applybids.id', $request->bid_id)
                ->select('applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                    'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon', 'sizes.size as vehicle_size',
                    'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                ->first();
            $msg = "Transport Consignment Detail";
        } elseif ($dat->category_id == '1') {
            $data = DB::table('applybids')
                ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                ->join('providers', 'providers.user_id', 'applybids.provider_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('categories', 'categories.id', 'userbids.category_id')
                ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                ->where('applybids.id', $request->bid_id)
                ->select('applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                    'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                    'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                ->first();
            $msg = "Tour And Travel Consignment Detail";
        } elseif ($dat->category_id == '3') {
            $data = DB::table('applybids')
                ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                ->join('providers', 'providers.user_id', 'applybids.provider_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('categories', 'categories.id', 'userbids.category_id')
                ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                ->join('flats', 'flats.id', 'userpackages.flat_type')
                ->where('applybids.id', $request->bid_id)
                ->select('applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email',
                    'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                    'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description', 'userpackages.order_id', 'userpackages.images', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image', 'flats.flat_type')
                ->first();
            $msg = "Packers&Movers Consignment Detail";
        }
        return response()->json(['status' => 1, 'message' => $msg, 'data' => $data]);


    }

    public function newconsumerOngoinConsignment()
    {
        $user = JWTAuth::user();
        $data = DB::table('userbids')->where('user_id', $user->id)->where('userbids.status', '!=', 'complete')->orWhere('userbids.status', '==', 'pending')
            ->orWhere('userbids.status', 'Inprogress')->get();
        if (count($data) > 0) {
            foreach ($data as $ongoingConsignment) {
                $datas = [];
                $tr = [];
                $pc = [];
                //   switch($user_category->category_id){
                if ($ongoingConsignment->category_id == '2') {

                    $bid = DB::table('userbids')
//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', 'userbids.id', 'applybids.userbids_id')
//                        ->leftJoin('applybids', function($query){
//                            $query->on('userbids.id', 'applybids.userbids_id')
//                                ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)')
//                                ->whereIn('applybids.status', ['Inprogress', 'payment complete']);
//                        })
                        //-- End Sayed Code --//
                        ->leftJoin('providers', 'applybids.provider_id', 'providers.user_id')
                        ->where('userbids.user_id', $user->id)
                        ->where('userbids.category_id', 2)
                        ->where('userbids.status', '!=', 'complete')
//                        ->select('applybids.*')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address',
                                            'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                                            'userbids.distance', 'userbids.ETA', 'userbids.status as consignment_status', 'usertransports.vehicle_bodytype',
                                            'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date',
                                            'usertransports.end_date', 'usertransports.loading_and_unloading', 'categories.category', 'categories.icon',
                                            'users.name as username', 'users.mobile as usermobile', 'users.email as useremail', 'sizes.size as vehicle_size',
                                            'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon', 'applybids.status as bid_status',
                                            'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.driver_phone', 'applybids.driver_license_image',
                                            'applybids.driver_image', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile',
                                            'providers.organisation_email as provider_email'
                        )
                        ->get();


                }
                elseif ($ongoingConsignment->category_id == '1') {
                    $bids = DB::table('userbids')
//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', 'userbids.id', 'applybids.userbids_id')
//                        ->leftJoin('applybids', function($query){
//                            $query->on('userbids.id', 'applybids.userbids_id')
//                                ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)')
//                                ->whereIn('applybids.status', ['Inprogress', 'payment complete']);
//                        })
                        //-- End Sayed Code --//
                        ->leftJoin('providers', 'applybids.provider_id', 'providers.user_id')
                        ->where('userbids.user_id', $user->id)
                        ->where('userbids.category_id', 1)
                        ->where('userbids.status', '!=', 'complete')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance', 'userbids.ETA', 'userbids.status as consignment_status', 'categories.category', 'categories.icon', 'users.name as username', 'users.mobile as usermobile', 'users.email as useremail',
                            'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name', 'vehicles.vehicle_icon as vehicle_icon', 'applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email')

                        ->get();


                }
                elseif ($ongoingConsignment->category_id == '3') {
                    $bidss = DB::table('userbids')->where('userbids.user_id', $user->id)

//                        ->where('userbids.status', '!=', 'pending')
                        //->orWhere('userbids.status','Inprogress')
                        //->where('userbids.status','!=','complete')->where('userbids.status','!=','pending')
                        ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('users', 'users.id', 'userbids.user_id')
                        ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                        ->join('flats', 'flats.id', 'userpackages.flat_type')
                        //-- Sayed Code --//
                        ->leftJoin('applybids', 'userbids.id', 'applybids.userbids_id')
//                        ->leftJoin('applybids', function($query){
//                            $query->on('userbids.id', 'applybids.userbids_id')
//                                ->whereRaw('applybids.id IN (select max(a.id) from applybids as a join userbids as u on u.id = a.userbids_id group by u.id)')
//                                ->whereIn('applybids.status', ['Inprogress', 'payment complete']);
//                        })
                        //-- End Sayed Code --//
                        ->leftJoin('providers', 'applybids.provider_id', 'providers.user_id')
                        ->where('userbids.category_id', 3)
                        ->where('userbids.status', '!=', 'complete')
                        ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat',
                            'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                            'userbids.distance', 'userbids.status as consignment_status', 'userbids.ETA', 'categories.category',
                            'categories.icon', 'users.name as username', 'users.mobile as usermobile', 'users.email as useremail',
                            'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description',
                            'userpackages.images', 'userpackages.order_id', 'flats.flat_type', 'vehicles.name', 'vehicles.vehicle_icon as vehicle_icon',
                            'applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id',
                            'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image',
                            'providers.organisation_name as provider_name', 'providers.mobile as provider_mobile', 'providers.organisation_email as provider_email')
                        ->get();


                }


            }
            if (isset($bid) && isset($bids) && isset($bidss)) {
                $array = array_merge($bid->toArray(), $bids->toArray(), $bidss->toArray());
            } elseif (isset($bid) && isset($bids)) {
                $array = array_merge($bid->toArray(), $bids->toArray());
            } elseif (isset($bid) && isset($bidss)) {
                $array = array_merge($bid->toArray(), $bidss->toArray());
            } elseif (isset($bids) && isset($bidss)) {
                $array = array_merge($bids->toArray(), $bidss->toArray());

            } elseif (isset($bid)) {
                $array = $bid;
            } elseif (isset($bids)) {
                $array = $bids;
            } elseif (isset($bidss)) {
                $array = $bidss;
            }
            // --------- Sayed Code ---------- //
            foreach ($array as $index=>$data){
                if($data->consignment_status == 'Inprogress' && $data->bid_status == 'pending'){
                    unset($array[$index]);
                }
                if($data->consignment_status == 'payment complete' && $data->bid_status == 'pending'){
                    unset($array[$index]);
                }
            }
            $consignment_exists = [];
            foreach ($array as $index=>$data){
                if(in_array($data->consignment_id, $consignment_exists)){
                    unset($array[$index]);
                }else{
                    array_push($consignment_exists, $data->consignment_id);
                }
            }
            if(count($array) > 0){
                $array=array_values($array);
            }else{
                return response()->json(['status' => 0, 'message' => 'No Ongoing Consignment Found', 'data' => []]);
            }
            // --------- End Sayed Code ---------- //
            return response()->json(['status' => 1, 'message' => 'Ongoing Consignment List', 'data' => $array]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No Ongoing Consignment Found', 'data' => []]);

        }
    }

    function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

}
