
@extends('layouts.master', ['activePage' => 'users', 'titlePage' => "users"])
@section('title', 'Users')

@section('content')

<div class="content">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-12">

                <div class="card card-chart">
                  <div class="card-header card-header-warning">
                    <div class="ct-chart">Provider Detail</div>
                  </div>
                  <div class="card-body">
                    <h4 class="card-title">Name:&nbsp;{{$data->name}}</h4>
                    <h4 class="card-title">Phone:&nbsp;{{$data->mobile}}</h4>
                    <h4 class="card-title">Email:&nbsp;{{$data->email}}</h4>

                  <span data-toggle="modal" data-target="#adharImage">
                      @if($data->aadhar_verified)
                       <i class="material-icons">check_circle</i>
                      @endif
                      @if(isset($data->aadhar_image)) <img style="width:32%; height:150px;"  src="{{$data->aadhar_image}}" /> @else f @endif
                  </span>
                <span data-toggle="modal" data-target="#panImage">
                    @if($data->pan_verified )
                     <i class="material-icons">check_circle</i>
                    @endif
                    @if(isset($data->pan_image)) <img style="width:32%; height:150px;" src="{{$data->pan_image}}" /> @else f @endif
                </span>
            <span data-toggle="modal" data-target="#gstImage">
                @if($data->gst_verified )
                 <i class="material-icons">check_circle</i>
                @endif
                @if(isset($data->gst_image)) <img style="width:32%; height:150px;" src="{{$data->gst_image}}" /> @else f @endif
            </span>
                  </div>
                  <div class="image">
                  {{-- </div>@if(isset($data->aadhar_image)) k @endif</div>
                  </div>@if(isset($data->pan_image)) k @endif</div>
                  </div>@if(isset($data->gst_image)) k @endif</div> --}}
                  </div>
                  <div class="card-footer">

                  </div>
                </div>


          </div>
       </div>
    </div>
 </div>

<!-- Modal -->
<div class="modal fade" id="adharImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adhar Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data->aadhar_image)) <img style="width:32%; height:150px;"  src="{{$data->aadhar_image}}" /> @else f @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if(isset($data->aadhar_image) && strlen($data->aadhar_image) > 0)
                <a type="button" href="{{ route('verifyDocument', ['id' => $data->id, 'type'=> 'adhar']) }}" class="btn btn-primary">Mark Verified</a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="panImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PAN Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data->pan_image)) <img style="width:32%; height:150px;" src="{{$data->pan_image}}" /> @else f @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if(isset($data->pan_image) && strlen($data->pan_image) > 0)
                <a type="button" href="{{ route('verifyDocument', ['id' => $data->id, 'type'=> 'pan']) }}" class="btn btn-primary">Mark Verified</a>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="gstImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">GST Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($data->gst_image)) <img style="width:32%; height:150px;" src="{{$data->gst_image}}" /> @else f @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if(isset($data->gst_image) && strlen($data->gst_image) > 0)
                <a type="button" href="{{ route('verifyDocument', ['id' => $data->id, 'type'=> 'gst']) }}" class="btn btn-primary">Mark Verified</a>
                @endif
            </div>
        </div>
    </div>
</div>



  @endsection

