<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function index()
    {
        $user['data'] = User::where('role', 3)->leftJoin('providers', 'users.id', 'providers.user_id')->select('users.id as id', 'name', 'email', 'providers.mobile', 'providers.id as provider_id', 'providers.is_active')->paginate(10);
        return view('admin/provider/index', $user);
    }

    public function viewDetail($id)
    {

        $detail['data'] = DB::table('users')->join('providers', 'providers.user_id', 'users.id')
            ->where('users.id', $id)->select('users.id', 'users.name', 'users.mobile', 'users.email', 'providers.gst_image', 'providers.aadhar_image', 'providers.pan_image', 'providers.gst_verified', 'providers.aadhar_verified', 'providers.pan_verified')->first();
        return view('admin/provider/viewdetail', $detail);
    }

    public function allBids(Request $request, $provider_id)
    {

        $provider_bid = DB::table('applybids')->where('provider_id', $provider_id)
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')
            ->get();
        if (count($provider_bid) > 0) {
            foreach ($provider_bid as $category) {
                if ($category->category_id == '2') {
                    $transport = DB::table('applybids')
                        ->where('applybids.provider_id', $provider_id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                        ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                        ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                        ->select('applybids.price as bid_price', 'applybids.status as status', 'applybids.id as bid_id', 'users.name as provider_name', 'users.mobile as provider_mobile', 'users.email as provider_email',
                            'userbids.ETA', 'userbids.source_address', 'userbids.destination_address', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon', 'sizes.size as vehicle_size',
                            'usertransports.vehicle_bodytype', 'usertransports.description', 'usertransports.order_id', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->get();
                } elseif ($category->category_id == '1') {
                    $tour = DB::table('applybids')
                        ->where('applybids.provider_id', $provider_id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                        ->select('applybids.price as bid_price', 'applybids.status as status', 'applybids.id as bid_id', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.ETA', 'userbids.source_address', 'userbids.destination_address', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                        ->get();
                } elseif ($category->category_id == '3') {
                    $package = DB::table('applybids')
                        ->where('applybids.provider_id', $provider_id)
                        ->join('users', 'users.id', 'applybids.provider_id')
                        ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                        ->join('categories', 'categories.id', 'userbids.category_id')
                        ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                        ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                        ->join('flats', 'flats.id', 'userpackages.flat_type')
                        ->select('applybids.price as bid_price', 'applybids.status as status', 'applybids.id as bid_id', 'users.name as provider_name', 'users.mobile as provider_email', 'users.email as provider_email',
                            'userbids.ETA', 'userbids.source_address', 'userbids.destination_address', 'userbids.distance', 'categories.category as category_name', 'categories.icon as category_icon',
                            'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.description', 'userpackages.order_id', 'userpackages.images', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image', 'flats.flat_type')
                        ->get();
                }

            }

            if (isset($tour) && isset($transport) && isset($package)) {
                $array['bids'] = array_merge($tour->toArray(), $transport->toArray(), $package->toArray());
            } elseif (isset($tour) && isset($package)) {
                $array['bids'] = array_merge($tour->toArray(), $package->toArray());
            } elseif (isset($tour) && isset($transport)) {
                $array['bids'] = array_merge($tour->toArray(), $transport->toArray());
            } elseif (isset($package) && isset($transport)) {
                $array['bids'] = array_merge($package->toArray(), $transport->toArray());

            } elseif (isset($transport)) {
                $array['bids'] = $transport;
            } elseif (isset($tour)) {
                $array['bids'] = $tour;
            } elseif (isset($package)) {
                $array['bids'] = $package;
            }
            return view('admin/provider/providerbid', $array);
        } else {
            $array['bids'] = [];
            return view('admin/provider/providerbid', $array);
        }
    }


    public function viewConsignment(Request $request, $bid_id)
    {
        $dataa = DB::table('applybids')->where('id', $bid_id)->first();
        $data = DB::table('userbids')->where('id', $dataa->userbids_id)->first();
        $category_id = $data->category_id;

        switch ($category_id) {
            case('1'):
                $consignment = DB::table('applybids')
                    ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                    ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                    ->join('providers', 'providers.user_id', 'applybids.provider_id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                    ->where('applybids.id', $bid_id)
                    ->where('userbids.id', $data->id)
                    ->where('userbids.category_id', $category_id)
                    ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat', 'providers.organisation_name', 'providers.organisation_email', 'providers.mobile', 'providers.gst_image', 'providers.pan_image', 'providers.aadhar_image',
                        'userbids.distance', 'userbids.status', 'categories.category', 'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email',
                        'usertours.date_of_travel as start_date', 'usertours.end_date', 'usertours.description', 'usertours.order_id', 'usertours.number_of_passenger', 'categories.id as category_id', 'categories.category', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')
                    ->first();
                break;

            case('2'):
                $consignment = DB::table('applybids')
                    ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                    ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                    ->join('providers', 'providers.user_id', 'applybids.provider_id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                    ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                    ->where('applybids.id', $bid_id)
                    ->where('userbids.id', $data->id)
                    ->where('userbids.category_id', $category_id)
                    ->select('userbids.id as consignment_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.distance', 'userbids.status', 'usertransports.description', 'usertransports.order_id', 'usertransports.vehicle_bodytype', 'usertransports.weight', 'usertransports.shifting_date as start_date', 'usertransports.end_date', 'usertransports.loading_and_unloading', 'categories.id as category_id', 'categories.category', 'providers.organisation_name', 'providers.organisation_email', 'providers.mobile', 'providers.gst_image', 'providers.pan_image', 'providers.aadhar_image',
                        'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')
                    ->first();
                break;
            case('3'):
                $consignment = DB::table('applybids')
                    ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                    ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                    ->join('providers', 'providers.user_id', 'applybids.provider_id')
                    ->join('categories', 'categories.id', 'userbids.category_id')
                    ->join('users', 'users.id', 'userbids.user_id')
                    ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                    ->join('flats', 'flats.id', 'userpackages.flat_type')
                    ->where('applybids.id', $bid_id)
                    ->where('userbids.id', $data->id)
                    ->where('userbids.category_id', $category_id)
                    ->select('userbids.id as userbid_id', 'userbids.source_address', 'userbids.destination_address', 'userbids.source_lat', 'userbids.source_long', 'userbids.destination_long', 'userbids.destination_lat',
                        'userbids.distance', 'userbids.status', 'userpackages.description', 'userpackages.order_id', 'userpackages.date_of_shifting as start_date', 'userpackages.end_date', 'userpackages.images as flat_images', 'flats.flat_type', 'categories.id as category_id', 'categories.category', 'providers.organisation_name', 'providers.organisation_email', 'providers.mobile', 'providers.gst_image', 'providers.pan_image', 'providers.aadhar_image',
                        'users.name as username', 'users.mobile as user_mobile', 'users.email as user_email', 'vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_icon')->first();
                break;
        }
        return view('admin/provider/biddetail', compact('consignment'));

    }

    public function addCoinForm($id)
    {
        $data['id'] = $id;
        $dat = DB::table('wallets')->where('user_id', $id)->select('points')->first();
        $data['coins'] = $dat->points;

        return view('admin/provider/coinform', $data);
    }

    public function submitCoin(Request $request)
    {
        $coin = DB::table('wallets')->where('user_id', $request->id)->first();
        DB::table('wallets')->where('user_id', $request->id)->update(['points' => $coin->points + $request->coin]);
        return redirect('providers');
    }

    public function toggleProviderStatus($id)
    {
        $provider = DB::table('providers')->where('id', $id)->first()->is_active;

        $res = DB::table('providers')->where('id', $id)->update(['is_active' => !$provider]);
        return redirect('providers');
    }

    public function verifyDocument($id, $type)
    {
        if($type == 'gst'){
            $provider = DB::table('providers')->where('user_id', $id)->update(['gst_verified'=> 1]);
        }
        if($type == 'pan'){
            $provider = DB::table('providers')->where('user_id', $id)->update(['pan_verified'=> 1]);
        }
        if($type == 'adhar'){
            $provider = DB::table('providers')->where('user_id', $id)->update(['aadhar_verified'=> 1]);
        }
        return redirect('providers');
    }
}
