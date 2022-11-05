
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-header card-header-primary">
                   <h4 class="card-title ">Providers</h4>
                   <p class="card-category"> Here you can manage providers</p>
                </div>
                <div class="card-body">
                        <div class="row">
                        <div class="col-12 text-left">
                            <abbr title="Export All Providers"><a href="{{url('/providerExport')}}" class="btn btn-sm btn-primary">Export</a></abbr>

                        </div>

                   {{-- <div class="row">
                      <div class="col-12 text-right">
                         <a href="#" class="btn btn-sm btn-primary">Add user</a>
                      </div>
                   </div> --}}
                   <div class="table-responsive">
                      <table class="table">
                         <thead class=" text-primary">
                            <tr>
                               <th>Sno.</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Role</th>
                               {{-- <th>Social Id</th>
                               <th>Status</th> --}}
                               {{-- <th class="text-right">Actions</th> --}}
                            </tr>
                         </thead>
                         <tbody>
                             @forelse($data as $provider)
                            <tr>
                               <td>
                                  {{$loop->iteration}}
                               </td>
                               <td>
                                {{$provider->name}}
                               </td>
                               <td>
                                {{$provider->email}}
                               </td>
                               <td>
                                Provider
                               </td>
                               <td>
                                <a href="{{url('allbids')}}/{{$provider->id}}"><i class="fa-solid fa-eye"></i></a>
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
                                <b> </b>No Users Found!</span>
                             </div>
                            @endforelse
                         </tbody>
                      </table>
                       {{ $data->links('vendor.pagination.bootstrap-4') }}
                   </div>
                </div>
             </div>

          </div>
       </div>
    </div>
 </div>



  @endsection
{{--
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function statusChange(id){
    var checkbox= document.getElementById(id);   //yes or no
    if(checkbox.checked == true)
        {
            value = 'yes';
        }
        else
        {
            value = 'no';

        }
    var user_id= document.getElementById(id).className;  //user id
    $.ajax({
         type:'GET',
         dataType:'JSON',
         url:'{{URL::to("userstatus")}}/'+user_id+'/'+value,
         success:function(data){
             console.log(data);
         }
    });

    }
</script> --}}
