@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.vehiclesize')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit Vehicle Size</h4>
                     <p class="card-category">Vehicle Size</p>
                  </div>
                  <div class="card-body ">

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="size"  type="text" placeholder="vehicle size" value="{!!str_replace('feet','',$veh->size) !!}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Vehicle Name</label>
                        <div class="col-sm-7">
                            <select name="vehicle_id" class='form-control' id="vehicle_id">
                                <option  disabled>Select Vehicle</option>
                                @foreach($vehicle as $vehicles)
                                @if($veh->vehicle_id == $vehicles->id)
                                <option selected   value="{{$vehicles->id}}">
                                @else
                                <option value="{{$vehicles->id}}">
                                @endif
                                {{$vehicles->name}}</option>

                                @endforeach

                        </select>
                      </div>
                    </div>

                  </div>
                  <input class="form-control" name="id"  type="hidden" placeholder="vehicle size" value="{{$veh->id}}" required="">
                  <input class="form-control" name="vehicl_id"  type="hidden" placeholder="vehicle size" value="{{$veh->vehicle_id}}" required="">

                  <div class="card-footer ml-auto mr-auto">
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


@endsection
