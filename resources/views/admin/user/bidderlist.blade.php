@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')
@section('content')
<style>
   .movee{
   animation: move 3s infinite forwards;
   }
   @keyframes move{
   0%   { left: -70px;}
   100% {left: 130px;}
   }
   .consumerHeading{background-image: linear-gradient(45deg, yellow, green, black, orange, pink, blue);
   background-clip: text;
   -webkit-background-clip: text;
   color: transparent;
   background-size:400%;
   animation :bg 6s infinite alternate
   }
   @keyframes bg{
   0%   { background-position: left;}
   100% {background-position: right;}
   }
   .clipp{
   border:1px solid red;
   background-color: red;
   width:50px;
   height:50px;
   }
   .item {
    position:relative;
    padding-top:20px;
    display:inline-block;
}
.notify-badge{
    position: absolute;
    right:-20px;
    top:10px;
    background:red;
    text-align: center;
    border-radius: 30px 30px 30px 30px;
    color:white;
    padding:5px 10px;
    font-size:20px;
}
</style>
<div style="position:relative; left:30px; top:80px;">
   <h1 class="consumerHeading">
   <b >Bidder List</b>
   <h1>
</div>
<div class="content">
   <div class="container-fluid">
      <div class="row">
         @forelse($bidderlist as $provider)
          @if ($provider['category']=='Tours & Travels')

         <div class="accordion accordion-flush" id="accordionFlushExample" style="padding-bottom:10px;">
            <div class="accordion-item">
                <div style="display:flex">
                    <span style=" display:flex; padding-left:1em; align-items:center;">
              <img src="{{$provider['category_icon']}}" style="width:65px; height:65px; border-radius:50%; background-color:aliceblue;" alt="no Image" />
                    </span>
               <h2  style="width:100%" class="accordion-header" id="flush-headingOne">
                  <button  class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush{{$provider['bidapply_id']}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$provider['description']}}
                  </button>
               </h2>

            </div>
            {{-- </div class="col-sm-6">j<div> --}}
               <div id="flush{{$provider['bidapply_id']}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="row pt-3">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                             <img src="{{$provider['provider_gst_image']}}" style=" width:250px; height:150px;">
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_pan_image']))
                             <img src="{{$provider['provider_pan_image']}}" style=" width:250px; height:150px;">
                             @else
                             <img src="{{asset('images/dummypan.png')}}" style=" width:250px; height:150px;">
                             @endif
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                           <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_aadhar_image']))
                              <img src="{{$provider['provider_aadhar_image']}}" style=" width:250px; height:150px;">
                              @else
                              <img src="{{asset('images/dummyaadhar.jpg')}}" style=" width:250px; height:150px;">
                              @endif
                           </div>
                     </div>
                 </div>
                <div class="row m-4">
                     <div class="col-sm-6">
                        <b>Provider Apply date</b>:&nbsp; <b class="text-muted">{{\Carbon\Carbon::parse($provider['start_date'])->format('d-m-Y')}}</b>
                     </div>
                     <div class="col-sm-6">
                        <b>Desription</b>:&nbsp; <b>{{$provider['description']}}</b>
                     </div>
                  </div>
                  <div class="row m-4">
                     <div class="col-sm-6">
                        <b>Bid Price</b>:&nbsp; <b>{{$provider['bid_apply_price']}}</b>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card"  style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                            <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                        </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['provider_name']}}</h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone" style="color:green;"></i>&nbsp;&nbsp;{{$provider['provider_phone']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope"  style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['provider_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card" style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                            <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                        </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['consumer_name']}}</h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone"  style="color:green;"></i>&nbsp;&nbsp;{{$provider['consumer_mobile']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope" style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['consumer_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                  </div>
               </div>
            </div>
         </div>
         @elseif ($provider['category']==='Transport')
         <div class="accordion accordion-flush" id="accordionFlushExample" style="padding-bottom:10px;">
            <div class="accordion-item">
                <div style="display:flex">
                    <span style=" display:flex; padding-left:1em; align-items:center;">
              <img src="{{$provider['category_icon']}}" style="width:65px; height:65px; border-radius:50%; background-color:aliceblue;" alt="no Image" />
                    </span>
               <h2  style="width:100%" class="accordion-header" id="flush-headingOne">
                  <button  class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush{{$provider['bidapply_id']}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$provider['description']}}
                  </button>
               </h2>

            </div>
               <div id="flush{{$provider['bidapply_id']}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="row pt-3">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                             <img src="{{$provider['provider_gst_image']}}" style=" width:250px; height:150px;">
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_pan_image']))
                             <img src="{{$provider['provider_pan_image']}}" style=" width:250px; height:150px;">
                             @else
                             <img src="{{asset('images/dummypan.png')}}" style=" width:250px; height:150px;">
                             @endif
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                           <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_aadhar_image']))
                              <img src="{{$provider['provider_aadhar_image']}}" style=" width:250px; height:150px;">
                              @else
                              <img src="{{asset('images/dummyaadhar.jpg')}}" style=" width:250px; height:150px;">
                              @endif
                           </div>
                     </div>
                 </div>



                <div class="row m-4">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Provider Apply date</b>:&nbsp; <b>{{\Carbon\Carbon::parse($provider['start_date'])->format('d-m-Y')}}</b>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Desription</b>:&nbsp; <b>{{$provider['description']}}</b>
                     </div>
                  </div>
                  <div class="row m-4">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Bid Price</b>:&nbsp; <b>{{$provider['bid_apply_price']}}</b>
                     </div>
                  </div>
                  <div class="row m-4">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                       <b>Vehicle</b>:&nbsp; <b>{{$provider['vehicle_name']}}</b>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                       <div class="item">
                           <a href="#">
                               <span class="notify-badge">NEW</span>
                               <img src="{{$provider['vehicle_image']}}"  style="width:120px; height:120px; alt="" /">
                           </a>
                       </div>
                    </div>
                 </div>
                  <div class="row">
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card"  style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                              <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                           </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['provider_name']}}&nbsp;<span class="text-muted">(Provider)</span></h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone" style="color:green;"></i>&nbsp;&nbsp;{{$provider['provider_phone']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope"  style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['provider_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card" style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                            <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                        </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['consumer_name']}}&nbsp;<span class="text-muted">(Consumer)</span></h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone"  style="color:green;"></i>&nbsp;&nbsp;{{$provider['consumer_mobile']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope" style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['consumer_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                  </div>
               </div>
            </div>
         </div>
         @elseif ($provider['category']==='Package Movers')
         <div class="accordion accordion-flush" id="accordionFlushExample" style="padding-bottom:10px;">
            <div class="accordion-item">
                <div style="display:flex">
                    <span style=" display:flex; padding-left:1em; align-items:center;">
              <img src="{{$provider['category_icon']}}" style="width:65px; height:65px; border-radius:50%; background-color:aliceblue;" alt="no Image" />
                    </span>
               <h2  style="width:100%" class="accordion-header" id="flush-headingOne">
                  <button  class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush{{$provider['bidapply_id']}}" aria-expanded="false" aria-controls="flush-collapseOne">
                  {{$provider['description']}}
                  </button>
               </h2>

            </div>
               <div id="flush{{$provider['bidapply_id']}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="row pt-3">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                             <img src="{{$provider['provider_gst_image']}}" style=" width:250px; height:150px;">
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">

                          <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_pan_image']))
                             <img src="{{$provider['provider_pan_image']}}" style=" width:250px; height:150px;">
                             @else
                             <img src="{{asset('images/dummypan.png')}}" style=" width:250px; height:150px;">
                             @endif
                          </div>


                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                           <div style="width:100%; text-align:center ">
                            @if(!empty($provider['provider_aadhar_image']))
                              <img src="{{$provider['provider_aadhar_image']}}" style=" width:250px; height:150px;">
                              @else
                              <img src="{{asset('images/dummyaadhar.jpg')}}" style=" width:250px; height:150px;">
                              @endif
                           </div>
                     </div>
                 </div>



                <div class="row m-4">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Provider Apply date</b>:&nbsp; <b>{{\Carbon\Carbon::parse($provider['start_date'])->format('d-m-Y')}}</b>
                     </div>
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Desription</b>:&nbsp; <b>{{$provider['description']}}</b>
                     </div>
                  </div>
                  <div class="row m-4">
                     <div class="col-lg-6 col-md-6 col-sm-6">
                        <b>Bid Price</b>:&nbsp; <b>{{$provider['bid_apply_price']}}</b>
                     </div>
                  </div>
                  <div class="row m-4">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                       <b>Vehicle</b>:&nbsp; <b>{{$provider['vehicle_name']}}</b>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                       <div class="item">
                           <a href="#">
                               <span class="notify-badge">NEW</span>
                               <img src="{{$provider['vehicle_image']}}"  alt="" style="width:120px; height:120px;"/>
                           </a>
                       </div>
                    </div>
                 </div>
                  <div class="row">
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card"  style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                              <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                           </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['provider_name']}}&nbsp;<span class="text-muted">(Provider)</span></h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone" style="color:green;"></i>&nbsp;&nbsp;{{$provider['provider_phone']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope"  style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['provider_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                     <div class="col-sm-4">
                        <div class="card" style="box-shadow: 1px 1px 2px 1px #ccdbd0">
                           <div style="width:100%; text-align:center ">
                            <img src="{{asset('images/Providerdummy.jpg')}}" style=" width:100px; height:100px; border-radius:50%;">
                        </div>
                           <div class="card-body">
                              <h5 class="card-title text-center">{{$provider['consumer_name']}}&nbsp;<span class="text-muted">(Consumer)</span></h5>
                              <h5 class="card-title text-center"> <i class="fa-solid fa-phone"  style="color:green;"></i>&nbsp;&nbsp;{{$provider['consumer_mobile']}}</h5>
                              <h5 class="card-title text-center"><i class="fa-solid fa-envelope" style="color:rgb(183, 0, 255);"></i>&nbsp;&nbsp;{{$provider['consumer_email']}}</h5>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-1"></div>
                  </div>
               </div>
            </div>
         </div>
         @endif
         @empty
         'No Data Found'
         @endforelse
      </div>
   </div>
</div>
@endsection
{{--
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
   function statusChange(id){
   var checkbox= document.getElementById(id);   //yes or no
   if(checkbox.checked == true)
       {
           value = 'yes';
       }
       else
       {
           value = 'no';

       }
   var user_id= document.getElementById(id).className;  //user id
   $.ajax({
        type:'GET',
        dataType:'JSON',
        url:'{{URL::to("userstatus")}}/'+user_id+'/'+value,
        success:function(data){
            console.log(data);
        }
   });

   }
</script> --}}
