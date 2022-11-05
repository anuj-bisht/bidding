<?php

namespace App\Http\Controllers\v1\Provider;

use App\Http\Controllers\Controller;
use App\Models\Applybid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class GetAllBidController extends Controller
{
    public function getAllBid()
    {
        $provider = JWTAuth::user();

        $provider_bid = DB::table('applybids')->where('provider_id', $provider->id)
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')
            ->get();
        if (sizeof($provider_bid) > 0) {

            foreach ($provider_bid as $category) {
                if ($category->category_id == '2') {
                    $transport = DB::table('applybids')
                        ->where('applybids.provider_id', $provider->id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                        ->select('applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.status as applybid_status', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_mobile', 'users.email as provider_email',
                            'userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon', 'sizes.size as vehicle_size',
                            'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->orderBy('applybids.price')->get();
                } elseif ($category->category_id == '1') {
                    $tour = DB::table('applybids')
                        ->where('applybids.provider_id', $provider->id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                        ->select('applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.status as applybid_status', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->orderBy('applybids.price')->get();
                } elseif ($category->category_id == '3') {
                    $package = DB::table('applybids')
                        ->where('applybids.provider_id', $provider->id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                        ->join('flats', 'flats.id', 'userpackages.flat_type')
                        ->select('applybids.price as bid_price', 'applybids.id as bid_id', 'applybids.status as applybid_status', 'applybids.driver_phone', 'applybids.driver_license_image', 'applybids.driver_image', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_lat', 'userbids.destination_long', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description', 'userpackages.order_id', 'userpackages.images', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image', 'flats.flat_type')
                        ->orderBy('applybids.price')->get();
                }
            }
        } else {
            return response()->json(['status' => 0, 'message' => 'No Bid Found', 'data' => []]);
        }
        if (isset($tour) && isset($transport) && isset($package)) {
            $array = array_merge($tour->toArray(), $transport->toArray(), $package->toArray());
        } elseif (isset($tour) && isset($package)) {
            $array = array_merge($tour->toArray(), $package->toArray());
        } elseif (isset($tour) && isset($transport)) {
            $array = array_merge($tour->toArray(), $transport->toArray());
        } elseif (isset($package) && isset($transport)) {
            $array = array_merge($package->toArray(), $transport->toArray());

        } elseif (isset($transport)) {
            $array = $transport;
        } elseif (isset($tour)) {
            $array = $tour;
        } elseif (isset($package)) {
            $array = $package;
        }
        if (sizeof($array) > 0) {
            return response()->json(['status' => 1, 'message' => 'Provider All Bid', 'data' => $array]);
        } else {
            return response()->json(['status' => 0, 'message' => 'No Bid Found', 'data' => []]);

        }

    }

    public function updateBid(Request $request)
    {
        $user = JWTAuth::user();
        $validator = Validator::make($request->all(), ['bid_id' => 'required', 'price' => 'required|numeric']);
        try {
            $bid = Applybid::where('id', $request->bid_id)->update(['price' => $request->price]);
//            $bid = Applybid::findOrFail($request->bid_id);
//            $bid->price = $request->price ? $request->price : $bid->price;
//            $bid->save();
            return response()->json(['status' => 1, 'message' => 'Bid Updated Successfully', 'data' => $bid]);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'message' => $e->getMessage()]);

        }
    }

    public function bidList(Request $request)
    {
        $user = JWTAuth::user();

        $data = DB::table('applybids')->where('applybids.provider_id', '!=', $user->id)
            ->where('applybids.userbids_id', $request->bid_id)
            ->join('providers', 'providers.user_id', 'applybids.provider_id')->get();
        $detail = [];
        foreach ($data as $bidder) {

            $det['price'] = $bidder->price;
            $det['provider_name'] = $bidder->organisation_name;
            $det['provider_email'] = $bidder->organisation_email;
            $det['provider_mobile'] = $bidder->mobile;
            array_push($detail, $det);
        }

        return response()->json(['status' => 1, 'message' => 'Bidder List', 'data' => $detail]);

    }
}
