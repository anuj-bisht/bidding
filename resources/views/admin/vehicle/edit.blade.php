@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.vehicle')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add Vehicle</h4>
                     <p class="card-category">Vehicle</p>
                  </div>
                  <div class="card-body ">

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-7">
                            <select name="category_id" class='form-control' id="category_id">
                                <option  disabled>Select Category</option>
                                @foreach($category as $categories)
                                @if($vehicle->category_id == $categories->id)
                                <option selected   value="{{$categories->id}}">
                                @else
                                <option value="{{$categories->id}}">
                                @endif
                                {{$categories->category}}</option>

                                @endforeach

                        </select>
                      </div>
                    </div>

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="name" value="{{$vehicle->name}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Per KM</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="KM"  type="text" placeholder="Per KM Price" value="{{$vehicle->per_KM}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-7">
                            <input class="form-control" name="vehicle_icon" value="{{$vehicle->vehicle_icon}}"  type="file" >
                            @isset($vehicle->vehicle_icon)
                            <img style="width:120px; height:120px; object-fit:contain;" src={{asset('vehicle/'.$vehicle->vehicle_icon)}} alt="Image"/>

                            @endisset
                      </div>
                    </div>

                  </div>
                  <input class="form-control" name="id"  type="hidden" placeholder="name" value="{{$vehicle->id}}" required="">
                  <input class="form-control" name="icon"  type="hidden" placeholder="name" value="{{$vehicle->vehicle_icon}}" required="">
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Update</button>
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
