
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header card-header-primary">
                   <h4 class="card-title ">Flats</h4>
                   <p class="card-category"> Here you can manage flats</p>
                </div>
                <div class="card-body">
                   <div class="row">
                     <div class="col-12 text-right">
                    <a href="{{route('create.flat')}}" class="btn btn-sm btn-primary">Add Flat</a>

                  </div>
                   </div>
                   <div class="table-responsive">
                      <table class="table">
                         <thead class=" text-primary">
                            <tr>
                               <th>Sno.</th>
                               <th>Flat Type</th>
                               {{-- <th>Social Id</th>
                               <th>Status</th> --}}
                               {{-- <th class="text-right">Actions</th> --}}
                            </tr>
                         </thead>
                         <tbody>
                             @forelse($data as $flat)
                            <tr>
                               <td>
                                  {{$loop->iteration}}
                               </td>
                               <td>
                                {{$flat->flat_type}}
                               </td>
                               <td class="td-actions text-right">
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{url('deleteFlat')}}/{{$flat->id}}" data-original-title="" title="">
                                    <i class="material-icons">delete</i>
                                   <div class="ripple-container"></div>
                                 </a>
                               </td>

                               {{-- <td>
                                {{($user->social_id)?$user->social_id:'nil'}}
                               </td>
                               <td>
                                @if($user->status==1)
                                <input type="checkbox" checked id="{{$user->id}}no"  class="{{$user->id}}"  onclick='statusChange(this.id)'>
                                @else
                                <input type="checkbox"   id="{{$user->id}}yes" class="{{$user->id}}" onclick='statusChange(this.id)'>
                                @endif
                               </td> --}}

                               {{-- <td class="td-actions text-right">
                                  <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                                     <i class="material-icons">edit</i>
                                     <div class="ripple-container"></div>
                                  </a>
                               </td> --}}
                            </tr>
                            @empty
                            <div class="alert alert-danger">
                                <span style="font-size:18px;">
                                <b> </b>No Flat Found!</span>
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

