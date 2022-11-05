
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')
<style>
    .movee{
        animation: move 3s infinite forwards;

    }
    @keyframes move{
        0%   { left: -70px;}

      100% {left: 130px;}
    }
    .consumerHeading{background-image: linear-gradient(45deg, yellow, green, grey, orange, pink);
         background-clip: text;
          -webkit-background-clip: text;
          color: transparent;
          background-size:400%;
          animation :bg 6s infinite alternate




    }
    @keyframes bg{
        0%   { background-position: left;}

      100% {background-position: right;}
    }
    .clipp{
        border:1px solid red;
        background-color: red;
        width:50px;
        height:50px;
    }
</style>
<div style="position:relative; left:30px; top:80px;">

    <h1 class="consumerHeading" ><b >Consignment Status</b><h1>


    </div>
<div style="position:relative; top:80px;">

    <div class="content">
        <div class="container-fluid">
           <div class="row">
              <div class="col-md-12 col-xl-12 col-sm-12 col-12">
                 <div class="card">
                    <div class="card-header card-header-primary">
                       <h4 class="card-title ">Conisgnment</h4>
                       <p class="card-category"> Here you can manage consignment</p>
                    </div>
                    <div class="card-body">
                       <div class="row">
                          <div class="col-12 text-left">
                             <a href="{{url('particularusertourconsignment')}}/{{$id}}" class="btn btn-sm btn-primary">Export Tour Cons.</a>
                             <a href="{{url('particularuserpackageconsignment')}}/{{$id}}" class="btn btn-sm btn-primary">Export Package Cons.</a>
                             <a href="{{url('particularusertransportconsignment')}}/{{$id}}" class="btn btn-sm btn-primary">Export Transport Cons.</a>

                          </div>
                       </div>
                       <div class="table-responsive" style="font-size:12px;">
                          <table class="table">
                             <thead class=" text-primary">
                                <tr>
                                   <th>Sno.</th>
                                   <th>Category</th>
                                   <th>Source Address</th>
                                   <th>Destination Address</th>
                                   <th>Distance</th>
                                   <th>ETA</th>
                                   <th>Status</th>
                                   {{-- <th>Social Id</th>
                                   <th>Status</th> --}}
                                   {{-- <th class="text-right">Actions</th> --}}
                                </tr>
                             </thead>
                             <tbody>
                                 @forelse($history as $consignment)
                                <tr>
                                   <td>
                                      {{$loop->iteration}}
                                   </td>
                                   <td>
                                    {{$consignment->category}}
                                   </td>
                                   <td>
                                    {{$consignment->source_address}}
                                   </td>
                                   <td>
                                    {{$consignment->destination_address}}
                                   </td>
                                   <td>
                                    {{$consignment->distance}}
                                   </td>
                                   <td>
                                    {{$consignment->ETA}}
                                   </td>
                                   <td style="font-size:15px;">
                                    @if($consignment->status==='pending')
                                    <span class="badge rounded-pill bg-danger">{{$consignment->status}}</span>
                                    @elseif ($consignment->status==='Inprogress')
                                    <span class="badge rounded-pill bg-primary">{{$consignment->status}}</span>
 				   @elseif ($consignment->status==='payment complete')
                                    <span class="badge rounded-pill bg-success">{{$consignment->status}}</span>
 				   @elseif ($consignment->status==='complete')
                                    <span class="badge rounded-pill bg-dark">{{$consignment->status}}</span>

                                    @endif
                                   </td>
                                   <td>
                                    <a href="{{url('bidderlist')}}/{{$consignment->consignment_id}}"><i class="fa-solid fa-eye"></i></a>
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
                                    <b> </b>No Consignment Found!</span>
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
