<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Traits\Common;
use App\Models\Notification;
use function PHPUnit\Framework\countOf;

class OngoingConsignmentController extends Controller
{
    use Common;
    public function providerOngoingConsignment()
    {
        $user = JWTAuth::user();
        $data = DB::table('applybids')->where('provider_id', $user->id)->where('applybids.status', '!=', 'complete')->where('applybids.status', '!=', 'pending')
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('category_id')->get();
        if (count($data) > 0) {
            $i=[];
            foreach ($data as $ongoingConsignment) {
                $datas = [];
                $tr = [];
                $pc = [];
                $d=0;
                $q=0;$w=0;
                if ($ongoingConsignment->category_id == '2') {
                    $bid = DB::table('applybids')
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->leftJoin('userbids', 'applybids.userbids_id', 'userbids.id')
                        ->leftJoin('categories', 'categories.id', 'userbids.category_id')
                        ->leftJoin('usertransports', 'usertransports.userbid_id', 'userbids.id')
                        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                        ->whereIn('applybids.status', ['Inprogress', 'payment complete'])
                        ->whereIn('userbids.status', ['Inprogress', 'payment complete'])
                        ->where('applybids.provider_id', $user->id)
                        ->where('users.id', $user->id)
                        ->select('users.id as user_id','applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_mobile', 'users.email as provider_email',
                            'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon', 'sizes.size as vehicle_size',
                            'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->get();
                } elseif ($ongoingConsignment->category_id == '1') {
                    $bids = DB::table('applybids')
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->leftJoin('userbids', 'applybids.userbids_id', 'userbids.id')
                        ->leftJoin('categories', 'categories.id', 'userbids.category_id')
                        ->leftJoin('usertours', 'usertours.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                        ->whereIn('applybids.status', ['Inprogress', 'payment complete'])
                        ->whereIn('userbids.status', ['Inprogress', 'payment complete'])
                        ->where('applybids.provider_id', $user->id)
                        ->select('users.id as user_id','applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->get();
                } elseif ($ongoingConsignment->category_id == '3') {
                    $bidss = DB::table('applybids')
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->leftJoin('userbids', 'applybids.userbids_id', 'userbids.id')
                        ->leftJoin('categories', 'categories.id', 'userbids.category_id')
                        ->leftJoin('userpackages', 'userpackages.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                        ->join('flats', 'flats.id', 'userpackages.flat_type')
                        ->where('applybids.provider_id', $user->id)
                        ->where('users.id', $user->id)
                        ->whereIn('applybids.status', ['Inprogress', 'payment complete'])
                        ->whereIn('userbids.status', ['Inprogress', 'payment complete'])
                        ->select('users.id as user_id','applybids.status as bid_status', 'applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.userbids_id as consignment_id', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.status as consignment_status', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description', 'userpackages.order_id', 'userpackages.images', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image', 'flats.flat_type')
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

            foreach ($array as $index=>$data){
                if($data->consignment_status == 'Inprogress' && $data->bid_status == 'pending'){
                    unset($array[$index]);
                }
                if($data->user_id != $user->id){
                    unset($array[$index]);
                }
            }
            if(count($array) > 0 && is_array($array)){
                $array=array_values($array);
            }
            return response()->json(['status' => 1, 'message' => 'Ongoing Consignment List', 'data' => $array]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No Ongoing Consignment Found', 'data' => []]);

        }
    }

    public function completeBid(Request $request)
    {
        $validate = Validator::make($request->all(), ['consignment_id' => 'required']);
        if($validate->fails()){
            return response()->json($validate->errors()->all());
        }
        $data = DB::table('userbids')->where('id', $request->consignment_id)->update(['status' => 'complete']);
        try {
            if ($data == 1) {
                $bidapply_id = $request->bidapply_id;

                $dat = DB::table('applybids')->where('id', $bidapply_id)->update(['status' => 'complete']);
                $dat = DB::table('applybids')->where('id', $bidapply_id)->first();
                //-- Sayed Code --//
                $userbids = DB::table('userbids')->where('id', $request->consignment_id)->first();
                $consumer = DB::table('users')->where('id', $userbids->user_id)->first();
                $suscription_titlee = "Consignment Complete";
                $suscription_msgg = $consumer->name . "," . "Has Completed BID with ID : " . $dat->userbids_id;
                $this->sendNotificationn($consumer->firebase_token, $suscription_titlee, $suscription_msgg);
                $notification = new Notification;
                $notification->user_id = $consumer->id;
                $notification->title = $suscription_titlee;
                $notification->message = $suscription_msgg;
                $notification->type = 'Consignment Complete';
                $notification->save();

                $user = JWTAuth::user();
                $suscription_titlee = "Consignment Complete";
                $suscription_msgg = JWTAuth::user()->name . "," . "Has Completed BID with ID : " . $dat->userbids_id;
                $this->sendNotificationn(JWTAuth::user()->firebase_token, $suscription_titlee, $suscription_msgg);
                $notification = new Notification;
                $notification->user_id = $user->id;
                $notification->title = $suscription_titlee;
                $notification->message = $suscription_msgg;
                $notification->type = 'Consignment Complete';
                $notification->save();
                //-- End Sayed Code --//
                return response()->json(['status' => 1, 'message' => 'ongoing status change to complete', 'data' => $dat]);

            } else {
                return response()->json(['status' => 0, 'message' => 'error', 'data' => []]);

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage(), 'data' => []]);

        }

    }

}
