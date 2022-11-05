@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('role.store')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">

                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Create Role</h4>
                     <p class="card-category">Role</p>
                  </div>
                  <div class="card-body ">


                     <div class="row">
                        <label class="col-sm-2 col-form-label">Role Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" placeholder="role" value="" required="">
                              @error('name')
                                  {{$message}}
                              @enderror
                           </div>
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



@endsection
