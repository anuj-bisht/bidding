@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.plan')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf


               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit Plan</h4>
                     <p class="card-category">Plan</p>
                  </div>
                  <div class="card-body ">



                      <div class="row">
                        <label class="col-sm-2 col-form-label">Plan Description</label>
                        <div class="col-sm-9">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="plan_description" id="plan_description" required="true" aria-required="true"  >{!! $plan->description !!}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="name" value="{{$plan->plan_name}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="price"  type="number" placeholder="Plan Price" value="{{$plan->plan_rate}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Coins</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="coins"  type="text" value="{{$plan->coins}}" placeholder="Coins"  required="">
                           </div>
                        </div>
                     </div>
                     {{-- <div class="row">
                        <label class="col-sm-2 col-form-label">Days</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="days"  type="text" placeholder="Plan Price" value="{{$plan->days}}" required="">
                           </div>
                        </div>
                     </div> --}}
                     {{-- <div class="row">
                        <label class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-7">
                            <input class="form-control" name="plan_image" value="{{$plan->image}}"  type="file" >
                            @isset($plan->image)
                            <img style="width:120px; height:120px; object-fit:contain;" src={{asset('plan/'.$plan->image)}} alt="Image"/>

                            @endisset
                      </div>
                    </div> --}}



                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <input class="form-control" name="id" value="{{$plan->id}}" type="hidden">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
<script type="text/javascript">

        CKEDITOR.replace( 'plan_description' );


 </script>

@endsection
