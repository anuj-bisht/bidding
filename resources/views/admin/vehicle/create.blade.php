@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('submit.vehicle')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
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
                                <option selected disabled>Select Category</option>
                                @foreach($category as $categories)
                                <option value="{{$categories->id}}">{{$categories->category}}</option>
                                @endforeach
                        </select>
                      </div>
                    </div>

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="name" value="" required="" pattern="^[^\s]+\s[^\s]+$" title="Accepted name with max Two words.">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Per KM</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="KM"  type="text" placeholder="Per KM Price" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Vehicle Icon</label>
                        <div class="col-sm-7">
                            <input class="form-control" name="vehicle_icon"  type="file"   required>
                      </div>
                    </div>

                  </div>
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

@push('js')
    <script>
        $(document).ready( function(){
            $('input[name="name"]').on('change', function(event){
                if(event.target.value.split(' ').length >2){
                }
            })
        })
    </script>
@endpush
