<?php

namespace App\Http\Controllers\Admin;
// use App\Http\Controllers\Traits\SendMail;
// use App\Http\Controllers\Traits\Common;
use Illuminate\Support\Carbon;
use App\Exports\ParticularUserConsignmentExport;
use App\Exports\ParticularPackageConsignmentExport;
use App\Exports\ParticularTransportConsignmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    // use SendMail;
    // use Common;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user['data']= User::where('role',2)->select('id','name','email','mobile')->paginate(15);
        return view('admin/user/index', $user);
    }


    public function UserBid($id){
        $array['id']=$id;
        $user=User::find($id);
        $user_history=DB::table('userbids')->where('userbids.user_id', $user->id)->get();
  $a=[];
if(count($user_history)>0){

        foreach($user_history as $user_category){

          //   switch($user_category->category_id){
               if($user_category->category_id=='2'){

                  $transport=DB::table('userbids')
                  ->where('userbids.user_id', $user->id)
                  ->where('userbids.category_id', 2)
                  ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
                  ->join('categories', 'categories.id', 'userbids.category_id')
                   ->join('users', 'users.id', 'userbids.user_id')
                  ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
                   ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
                   ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.ETA',
                          'userbids.distance','userbids.status','usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading', 'categories.category','categories.id as category_id',
                           'users.name as username','users.mobile as user_mobile', 'users.email as user_email', 'sizes.size as vehicle_size', 'vehicles.name as vehicle_name','vehicles.vehicle_icon as vehicle_icon')
                           ->latest('userbids.created_at')->get();
                }
              elseif($user_category->category_id=='1'){
                  $tour=DB::table('userbids')
                  ->where('userbids.user_id', $user->id)
                 ->where('userbids.category_id', 1)
                 ->join('usertours','usertours.userbid_id', 'userbids.id')
                 ->join('categories', 'categories.id', 'userbids.category_id')
                 ->join('users', 'users.id', 'userbids.user_id')
                 ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                  ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.ETA',
                  'userbids.distance','userbids.status', 'categories.category','categories.id as category_id','users.name as username','users.mobile as user_mobile', 'users.email as user_email',
                  'usertours.date_of_travel as start_date', 'usertours.end_date','usertours.description','usertours.order_id', 'usertours.number_of_passenger', 'vehicles.name','vehicles.vehicle_icon as vehicle_icon')
                  ->latest('userbids.created_at')->get();
                }
                elseif($user_category->category_id=='3'){
                  $package=DB::table('userbids')
                  ->where('userbids.user_id', $user->id)
                 ->where('userbids.category_id', 3)
                 ->join('userpackages','userpackages.userbid_id', 'userbids.id')
                 ->join('categories', 'categories.id', 'userbids.category_id')
                 ->join('users', 'users.id', 'userbids.user_id')
                 ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                 ->join('flats','flats.id', 'userpackages.flat_type')
                  ->select('userbids.id as consignment_id','userbids.source_address','userbids.destination_address','userbids.ETA',
                  'userbids.distance','userbids.status', 'categories.category', 'categories.id as category_id','users.name as username','users.mobile as user_mobile', 'users.email as user_email',
                  'userpackages.date_of_shifting as start_date','userpackages.description','userpackages.images','userpackages.order_id', 'flats.flat_type', 'vehicles.name','vehicles.vehicle_icon as vehicle_icon')
                  ->latest('userbids.created_at')->get();
                }
        }
      if(isset($tour) && isset($transport) && isset($package)){
          $array['history'] =  array_merge($tour->toArray(), $transport->toArray(), $package->toArray());
       }
       elseif(isset($tour) && isset($package)){
          $array['history'] =  array_merge($tour->toArray(), $package->toArray());
         }
       elseif(isset($tour) && isset($transport)){
        $array['history'] =  array_merge($tour->toArray(), $transport->toArray());
       }
       elseif(isset($package) && isset($transport)){
          $array['history'] =  array_merge($package->toArray(), $transport->toArray());

      }elseif(isset($transport)){
          $array['history'] =  $transport;
       }
       elseif(isset($tour)){
          $array['history'] =  $tour;
       }
       elseif(isset($package)){
          $array['history'] =  $package;
       }

        return view('admin/user/userbid', $array);
}else{
        $array['history']=[];
        return view('admin/user/userbid', $array);
    }
    }


    public function bidderList(Request $request,$consignment_id){

        $check_category=DB::table('applybids')->where('userbids_id', $request->consignment_id)
        ->join('userbids', 'userbids.id', 'applybids.userbids_id')->select('userbids.category_id')
        ->get();

        foreach($check_category as $category){
            $datas['bidderlist']=[];

            if($category->category_id=='2'){
        $bid=DB::table('applybids')->where('userbids_id', $request->consignment_id)
            ->join('userbids', 'userbids.id', 'applybids.userbids_id')
            ->join('categories','categories.id','userbids.category_id')
            ->join('providers', 'providers.user_id', 'applybids.provider_id')
            ->join('users', 'users.id', 'userbids.user_id')
            ->join('usertransports', 'usertransports.userbid_id', 'userbids.id')
            ->join('sizes', 'sizes.id', 'usertransports.vehicle_size_id')
            ->join('vehicles', 'vehicles.id', 'sizes.vehicle_id')
            ->where('userbids.status','!=','Inprogress')
            ->orWhere('userbids.status','!=','complete')
            ->select('applybids.id','applybids.price','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
            'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail','sizes.size as vehicle_size',
            'usertransports.vehicle_bodytype','usertransports.description','usertransports.order_id', 'usertransports.weight','usertransports.shifting_date as start_date','usertransports.loading_and_unloading','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
            ->latest('applybids.created_at')->get();
            foreach($bid as $transport){
                $transportt['bidapply_id']=$transport->id;
                $transportt['bid_apply_price']=$transport->price;
                $transportt['category']=$transport->category;
                $transportt['category_icon']=$transport->icon;
                $transportt['provider_name']=$transport->organisation_name;
                $transportt['provider_gst_image']=$transport->gst_image;
                $transportt['provider_pan_image']=$transport->pan_image;
                $transportt['provider_aadhar_image']=$transport->aadhar_image;
                $transportt['provider_phone']=$transport->mobile;
                $transportt['provider_email']=$transport->organisation_email;
                $transportt['source_address']=$transport->source_address;
                $transportt['destination_address']=$transport->destination_address;
                $transportt['distance']=$transport->distance;
                $transportt['consumer_name']=$transport->username;
                $transportt['consumer_mobile']=$transport->usermobile;
                $transportt['consumer_email']=$transport->useremail;
                $transportt['vehicle_bodytype']=$transport->vehicle_bodytype;
                $transportt['description']=$transport->description;
                $transportt['order_id']=$transport->order_id;
                $transportt['weight']=$transport->weight;
                $transportt['start_date']=$transport->start_date;
                $transportt['loading_and_unloading']=$transport->loading_and_unloading;
                $transportt['vehicle_size']=$transport->vehicle_size;
                $transportt['vehicle_name']=$transport->vehicle_name;
                $transportt['vehicle_image']=$transport->vehicle_image;
                array_push($datas['bidderlist'], $transportt);
            }


            }
            elseif($category->category_id=='1'){

                $bids=DB::table('applybids')->where('userbids_id', $request->consignment_id)
                ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                ->join('categories','categories.id','userbids.category_id')
                ->join('providers', 'providers.user_id', 'applybids.provider_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('usertours', 'usertours.userbid_id', 'userbids.id')
                 ->join('vehicles', 'vehicles.id', 'usertours.vehicle_id')
                 ->where('userbids.status','!=','Inprogress')
                 ->orWhere('userbids.status','!=','complete')
                 ->select('applybids.id','applybids.price','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
                 'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail'
                ,'usertours.description','usertours.order_id','usertours.date_of_travel as start_date','usertours.end_date','usertours.number_of_passenger','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image')
                 ->latest('applybids.created_at')->get();

                 foreach($bids as $tour){

                    $tourr['bidapply_id']=$tour->id;
                    $tourr['bid_apply_price']=$tour->price;
                    $tourr['category']=$tour->category;
                    $tourr['category_icon']=$tour->icon;
                    $tourr['provider_name']=$tour->organisation_name;
                    $tourr['provider_gst_image']=$tour->gst_image;
                    $tourr['provider_pan_image']=$tour->pan_image;
                    $tourr['provider_aadhar_image']=$tour->aadhar_image;
                    $tourr['provider_phone']=$tour->mobile;
                    $tourr['provider_email']=$tour->organisation_email;
                    $tourr['source_address']=$tour->source_address;
                    $tourr['destination_address']=$tour->destination_address;
                    $tourr['distance']=$tour->distance;
                    $tourr['consumer_name']=$tour->username;
                    $tourr['consumer_mobile']=$tour->usermobile;
                    $tourr['consumer_email']=$tour->useremail;
                    $tourr['description']=$tour->description;
                    $tourr['order_id']=$tour->order_id;
                    $tourr['start_date']=$tour->start_date;
                    $tourr['end_date']=$tour->end_date;
                    $tourr['number_of_passenger']=$tour->number_of_passenger;
                    $tourr['vehicle_name']=$tour->vehicle_name;
                    $tourr['vehicle_image']=$tour->vehicle_image;
                    array_push($datas['bidderlist'], $tourr);
                }



            }
            elseif($category->category_id=='3'){

                $bidss=DB::table('applybids')->where('userbids_id', $request->consignment_id)
                ->join('userbids', 'userbids.id', 'applybids.userbids_id')
                ->join('categories','categories.id','userbids.category_id')
                ->join('providers', 'providers.user_id', 'applybids.provider_id')
                ->join('users', 'users.id', 'userbids.user_id')
                ->join('userpackages', 'userpackages.userbid_id', 'userbids.id')
                 ->join('vehicles', 'vehicles.id', 'userpackages.vehicle_id')
                 ->join('flats', 'flats.id', 'userpackages.flat_type')
                 ->where('userbids.status','!=','Inprogress')
                 ->orWhere('userbids.status','!=','complete')
                 ->select('applybids.id','applybids.price','categories.category','categories.icon','providers.organisation_name','providers.organisation_email','providers.mobile','providers.gst_image','providers.pan_image','providers.aadhar_image',
                 'userbids.source_address','userbids.destination_address','userbids.source_lat','userbids.source_long','userbids.destination_lat','userbids.destination_long','userbids.distance','users.name as username', 'users.mobile as usermobile', 'users.email as useremail'
                ,'userpackages.description','userpackages.order_id','userpackages.date_of_shifting as start_date','userpackages.images','vehicles.name as vehicle_name', 'vehicles.vehicle_icon as vehicle_image','flats.flat_type')
                 ->latest('applybids.created_at')->get();

                 foreach($bidss as $package){

                    $packagee['bidapply_id']=$package->id;
                    $packagee['bid_apply_price']=$package->price;
                    $packagee['category']=$package->category;
                    $packagee['category_icon']=$package->icon;
                    $packagee['provider_name']=$package->organisation_name;
                    $packagee['provider_gst_image']=$package->gst_image;
                    $packagee['provider_pan_image']=$package->pan_image;
                    $packagee['provider_aadhar_image']=$package->aadhar_image;
                    $packagee['provider_phone']=$package->mobile;
                    $packagee['provider_email']=$package->organisation_email;
                    $packagee['source_address']=$package->source_address;
                    $packagee['destination_address']=$package->destination_address;
                    $packagee['distance']=$package->distance;
                    $packagee['consumer_name']=$package->username;
                    $packagee['consumer_mobile']=$package->usermobile;
                    $packagee['consumer_email']=$package->useremail;
                    $packagee['description']=$package->description;
                    $packagee['order_id']=$package->order_id;
                    $packagee['start_date']=$package->start_date;
                    $packagee['images']=$package->images;
                    $packagee['flat_type']=$package->flat_type;
                    $packagee['vehicle_name']=$package->vehicle_name;
                    $packagee['vehicle_image']=$package->vehicle_image;

                    array_push($datas['bidderlist'], $packagee);
                }





        }

        return view('admin/user/bidderlist', $datas);
    }




    }






public function notification(){
    $data['user']=DB::table('users')->get();
    return view('admin/user/notification', $data);
}
    public function sendNotificationAllUser(Request $request){
        //dd("sendemailall");
	$user = User::get();
	foreach($user as $value){
            $diviceIds = [$value->device_token];
            if(isset($diviceIds)){
           	$suscription_title = "User Test";
                $suscription_msg = "User Test Successfully";
           	$this->sendNotification($diviceIds,'',$suscription_title,$suscription_msg);
            }
	}
	$userData = User::orderBy('id','DESC')->get();
	return view('users.sendNotification',compact('userData'));
    }

    public function sendNotificationUser(Request $request){
        $data = $request->name;//dd($request->all(),$request->name);

	$suscription_title = $request->title;
        $suscription_msg = $request->message;
	foreach($data as $value){
        	$user = User::where('id',$value)->first();
		$diviceIds = [$user->device_token];
        	if(isset($diviceIds)){

                    $data = $this->sendNotification($diviceIds,'',$suscription_title,$suscription_msg);
	            if($data){
			$userData = User::orderBy('id','DESC')->get();
			return view('admin/user/notification',compact('userData'));
	   	    }
        	}
	}
    }

public function viewDetail($id){
$detail['data']=DB::table('users')->where('id',$id)->select('name','mobile','email')->first();

return view('admin/user/viewdetail',$detail);
}
public function particularUserConsignment($id){
    $user=User::find($id);
    return Excel::download(new ParticularUserConsignmentExport($id), "$user->name"." "."Tour Consignment"." ".Carbon::now().".xlsx");
}
public function particularPackageConsignment($id){
    $user=User::find($id);
    return Excel::download(new ParticularPackageConsignmentExport($id), "$user->name"." "."Package Consignment"." ".Carbon::now().".xlsx");
}
public function particularTransportConsignment($id){
    $user=User::find($id);
    return Excel::download(new ParticularTransportConsignmentExport($id), "$user->name"." "."Transport Consignment"." ".Carbon::now().".xlsx");
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
