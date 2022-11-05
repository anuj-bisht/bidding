
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header card-header-primary">
                   <h4 class="card-title ">Permission</h4>
                   <p class="card-category"> Here you can manage Permission</p>
                </div>
                <div class="card-body">
                   <div class="row">
                      <div class="col-12 text-right">
                         <a href="{{route('create.permission')}}" class="btn btn-sm btn-primary">Create Permission</a>
                      </div>
                   </div>
                   <div class="row">
                    <div class="col-12 text-center">
                       @if(Session::has('message'))
                       <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>{{Session::get('message')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                       @endif
                    </div>
                 </div>
                   <div class="table-responsive">
                      <table class="table">
                         <thead class=" text-primary">
                            <tr>
                               <th>Sno.</th>
                               <th>Permission</th>
                               <th class="text-right">Actions</th>
                            </tr>
                         </thead>
                         <tbody>
                             @forelse($data as $permission)
                            <tr>
                               <td>
                                  {{$loop->iteration}}
                               </td>
                               <td>
                                {{$permission->name}}
                               </td>

                               <td class="text-right">
                                <a href="{{url('edit/permission')}}/{{$permission->id}}"><i class="fa-solid fa-pen"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="{{url('delete/permission')}}/{{$permission->id}}"><i class="fa-solid fa-xmark"></i></a>
                               </td>

                            </tr>
                            @empty
                            <div class="alert alert-danger">
                                <span style="font-size:18px;">
                                <b> </b>No Users Found!</span>
                             </div>
                            @endforelse
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>

          </div>
       </div>
    </div>
 </div>



  @endsection

