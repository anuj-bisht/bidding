@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{url('update/role',$role->id)}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit Role</h4>
                     <p class="card-category">Role</p>
                  </div>
                  <div class="card-body ">


                     <div class="row">
                        <label class="col-sm-2 col-form-label">Role Name</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="name"  type="text" value="{{$role->name}}" placeholder="role" value="" required="">
                              @error('name')
                                  {{$message}}
                              @enderror
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">update</button>
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

         <span style="color:red;"> <b>Note</b><sup>*</sup>:&nbsp;&nbsp;You can delete these permissions by clicking on particular icon.</span>

        </div>
     </div>
      <div class="row">
        <div class="col-md-12" style='display:flex;'>
         @if($role->permissions)
         @foreach ($role->permissions as $role_permission)
         <form method="post" action="{{url('admin/roles',[$role->id, $role_permission->id])}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
             <span><button type="submit" class="btn btn-info">{{$role_permission->name}}</button></span>
         </form>
         @endforeach
         @endif
        </div>
     </div>






      <div class="row">
        <div class="col-md-12">
           <form method="post" action="{{route('admin.roles.permissions',$role->id)}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
               @csrf

              <div class="card">
                 <div class="card-header card-header-primary">
                    <h4 class="card-title">Role Permission</h4>

                 </div>
                 <div class="card-body ">


                    <div class="row">
                       <label class="col-sm-2 col-form-label">Permissions</label>
                       <div class="col-sm-7">
                          <div class="form-group bmd-form-group is-filled">
                            <select name="permission" class='form-control' id="permission">
                                <option disabled selected>Select Permission</option>
                                @foreach($permissions as $permission)
                                <option value="{{$permission->name}}">{{$permission->name}}</option>
                                @endforeach
                        </select>
                          </div>
                       </div>
                    </div>

                 </div>
                 <div class="card-footer ml-auto mr-auto">
                   <button type="submit" class="btn btn-primary">Assign Permission</button>
               </div>
              </div>
           </form>
        </div>
     </div>
   </div>
</div>



@endsection
