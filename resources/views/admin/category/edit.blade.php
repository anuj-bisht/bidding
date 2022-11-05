@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.categories')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">


                @csrf
                <input class="form-control" name="category_id"  type="hidden" placeholder="Add Category" value="{{$categories->id}}" required="">
               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add Category</h4>

                  </div>
                  <div class="card-body ">
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Edit Category</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                            <input class="form-control" name="category"  type="text" placeholder="Add Category" value="{{$categories->category}}" required="" readonly>
                        </div>
                        </div>
                     </div>

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Parent Category</label>
                        <div class="col-sm-7">
                            <select name="parent_category" class='form-control' id="parent_category" readonly>
                                @if($categories->parent_category=='0')
                                <option selected value="0">Parent Category</option>
                                @endif
                                @foreach($parent_category as $parent_category_id)

                                @if($categories->parent_category==$parent_category_id->id)

                                <option selected value="{{$parent_category_id->id}}">
                                @else
                                <option value="{{$parent_category_id->id}}">

                                @endif
                                {{$parent_category_id->category}}</option>

                                @endforeach
                                {{-- @foreach($category as $allcategory)
                                <option value="{{$allcategory->id}}">{{$allcategory->category}}</option>
                                @endforeach --}}
                        </select>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-7">
                            <input class="form-control" name="transport_icon" value={{$categories->icon}}  type="file" >
                            @isset($categories->icon)
                            <img style="width:120px; height:120px; object-fit:contain;" src={{$categories->icon}} alt="Image"/>

                            @endisset
                      </div>
                    </div>
                    </div>





                    </div>
                    <input class="form-control" name="icon" value={{$categories->icon}}  type="hidden" >

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

@endsection
