@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{url('update/permission',$permission->id)}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit Permission</h4>
                     <p class="card-category">Permission</p>
                  </div>
                  <div class="card-body ">


                     <div class="row">
                        <label class="col-sm-2 col-form-label">Permission Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text"  value="{{$permission->name}}" placeholder="Permission" value="" required="">
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



      <div class="row">
        <div class="col-12 text-center " >
           @if(Session::has('message'))
           <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
           @endif
        </div>
        <div class="row">
            <div class="col-md-12" style='display:flex;'>

             <span style="color:red;"> <b>Note</b><sup>*</sup>:&nbsp;&nbsp;You can delete these Roles by clicking on particular icon.</span>

            </div>
         </div>
          <div class="row">
            <div class="col-md-12" style='display:flex;'>
             @if($permission->roles)
             @foreach ($permission->roles as $permission_role)
             <form method="post" action="{{url('admin/permissions',[$permission->id, $permission_role->id])}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                 <span><button type="submit" class="btn btn-info">{{$permission_role->name}}</button></span>
             </form>
             @endforeach
             @endif
            </div>
         </div>






          <div class="row">
            <div class="col-md-12">
               <form method="post" action="{{route('admin.permissions.roles',$permission->id)}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                   @csrf

                  <div class="card">
                     <div class="card-header card-header-primary">
                        <h4 class="card-title">Roles</h4>

                     </div>
                     <div class="card-body ">


                        <div class="row">
                           <label class="col-sm-2 col-form-label">Roles</label>
                           <div class="col-sm-7">
                              <div class="form-group bmd-form-group is-filled">
                                <select name="role" class='form-control' id="role">
                                    <option disabled selected>Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                            </select>
                              </div>
                           </div>
                        </div>

                     </div>
                     <div class="card-footer ml-auto mr-auto">
                       <button type="submit" class="btn btn-primary">Assign Role</button>
                   </div>
                  </div>
               </form>
            </div>
         </div>
       </div>
   </div>
</div>



@endsection
