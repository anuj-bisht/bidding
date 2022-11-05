
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header card-header-primary">
                   <h4 class="card-title ">Vehicles Size</h4>
                   <p class="card-category"> Here you can manage vehicle size </p>
                </div>
                <div class="card-body">
                   <div class="row">
                         <div class="col-12 text-right">
                    <a href="{{route('create.vehiclesize')}}" class="btn btn-sm btn-primary">Add Size</a>
                 </div>
                   </div>

                   <div class="table-responsive">
                      <table class="table">
                         <thead class=" text-primary">
                            <tr>
                               <th>Sno.</th>
                               <th>Size</th>
                               <th>Name</th>


                               {{-- <th>Social Id</th>
                               <th>Status</th> --}}
                               <th class="text-right">Actions</th>
                            </tr>
                         </thead>
                         <tbody>
                             @forelse($veh as $vehicles)
                            <tr>
                               <td>
                                  {{$loop->iteration}}
                               </td>
                               <td>
                                {{$vehicles->size}}
                               </td>
                               <td>
                                {{$vehicles->name}}
                               </td>
                               <td class="td-actions text-right">
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{url('editvehiclesize')}}/{{$vehicles->id}}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                 </a>
 				<a rel="tooltip" class="btn btn-success btn-link" href="{{url('deletevehiclesize')}}/{{$vehicles->id}}" data-original-title="" title="">
                                    <i class="material-icons">delete</i>
                                    <div class="ripple-container"></div>
                                 </a>
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

